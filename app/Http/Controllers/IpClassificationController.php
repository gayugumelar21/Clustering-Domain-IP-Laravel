<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IpClassA;
use App\Models\IpClassB;
use App\Models\IpClassC;

class IpClassificationController extends Controller
{
    // Fungsi untuk menentukan kelas IP
    private function getIpClass($ipAddress)
    {
        $firstOctet = (int)explode('.', $ipAddress)[0];

        if ($firstOctet >= 1 && $firstOctet <= 126) {
            return 'Class A';
        } elseif ($firstOctet >= 128 && $firstOctet <= 191) {
            return 'Class B';
        } elseif ($firstOctet >= 192 && $firstOctet <= 223) {
            return 'Class C';
        } else {
            return 'Lainnya';
        }
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'domain_file' => 'required|file|mimes:txt',
        ]);

        $file = $request->file('domain_file');
        $fileHandle = fopen($file->getRealPath(), 'r');

        if ($fileHandle) {
            // Batching records
            $batchSize = 100;
            $batchA = [];
            $batchB = [];
            $batchC = [];

            while (($domain = fgets($fileHandle)) !== false) {
                $domain = trim($domain);
                if (empty($domain)) {
                    continue;
                }

                $ipAddress = gethostbyname($domain);
                if ($ipAddress === $domain) {
                    // Domain tidak valid
                    continue;
                }

                $ipClass = $this->getIpClass($ipAddress);
                $data = ['domain' => $domain, 'ip_address' => $ipAddress];

                switch ($ipClass) {
                    case 'Class A':
                        $batchA[] = $data;
                        break;
                    case 'Class B':
                        $batchB[] = $data;
                        break;
                    case 'Class C':
                        $batchC[] = $data;
                        break;
                }

                // Insert batches to the database
                if (count($batchA) >= $batchSize) {
                    IpClassA::insert($batchA);
                    $batchA = [];
                }
                if (count($batchB) >= $batchSize) {
                    IpClassB::insert($batchB);
                    $batchB = [];
                }
                if (count($batchC) >= $batchSize) {
                    IpClassC::insert($batchC);
                    $batchC = [];
                }
            }

            fclose($fileHandle);

            // Insert any remaining records
            if (!empty($batchA)) {
                IpClassA::insert($batchA);
            }
            if (!empty($batchB)) {
                IpClassB::insert($batchB);
            }
            if (!empty($batchC)) {
                IpClassC::insert($batchC);
            }

            return back()->with('success', 'Clustering IP selesai.');
        }

        return back()->with('error', 'File tidak valid atau kosong.');
    }

    public function showResults(Request $request)
    {
        $ipClass = $request->input('ip_class');

        if ($ipClass == 'Class A') {
            $results = IpClassA::all();
        } elseif ($ipClass == 'Class B') {
            $results = IpClassB::all();
        } elseif ($ipClass == 'Class C') {
            $results = IpClassC::all();
        } else {
            return back()->with('error', 'Kelas IP tidak valid.');
        }

        return view('results', ['results' => $results, 'class' => $ipClass]);
    }
}
