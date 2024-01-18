<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

class deviceController extends Controller
{

    public function remoteData($url)
    {
        $client = HttpClient::create(['max_redirects' => 0]);
        try {
            $response = $client->request('GET', $url);
            $statusCode = $response->getStatusCode();

            if ($statusCode >= 300 && $statusCode < 400) {
                return false;
            }
            $htmlContent = $response->getContent();
            $crawler = new Crawler($htmlContent);
            if ($crawler->filterXPath('//title')->count() > 0) {
                $title = $crawler->filterXPath('//title')->text();
                // if()
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function show($id)

    {
        $pixelExperiance = deviceController::remoteData('https://get.pixelexperience.org/' . $id);
        $pixelos = deviceController::remoteData('https://pixelos.net/download/' . $id);
        $evolutionx = deviceController::remoteData('https://evolution-x.org/device/' . $id);
        $hyperos = deviceController::remoteData('https://xiaomifirmwareupdater.com/hyperos/' . $id . '/');
        $lineageos = deviceController::remoteData('https://wiki.lineageos.org/devices/' . $id . '/');

        $baikalos = deviceController::remoteData('https://sourceforge.net/projects/baikalos/files/' . $id . '/');
        if (!$baikalos) {
            $baikalos = deviceController::remoteData('https://sourceforge.net/projects/ancientrom/files/' . ucwords($id) . '/');
            $baikalosCode = ucwords($id);
        } else {
            $baikalos = deviceController::remoteData('https://sourceforge.net/projects/baikalos/files/' . $id . '/');
            $baikalosCode = $id;
        }
        $superioros = deviceController::remoteData('https://sourceforge.net/projects/superioros/files/' . $id . '/');
        if (!$superioros) {
            $superioros = deviceController::remoteData('https://sourceforge.net/projects/ancientrom/files/' . ucwords($id) . '/');
            $superiorosCode = ucwords($id);
        } else {
            $superiorosCode = $id;
        }

        $projectmatrixx = deviceController::remoteData('https://sourceforge.net/projects/projectmatrixx/files/Android-14/' . $id . '/');
        if (!$projectmatrixx) {
            $projectmatrixx = deviceController::remoteData('https://sourceforge.net/projects/ancientrom/files/' . ucwords($id) . '/');
            $projectmatrixxCode = ucwords($id);
        } else {
            $projectmatrixxCode = $id;
        }
        $ancientrom = deviceController::remoteData('https://sourceforge.net/projects/ancientrom/files/' . $id . '/');
        if (!$ancientrom) {
            $ancientrom = deviceController::remoteData('https://sourceforge.net/projects/ancientrom/files/' . ucwords($id) . '/');
            $ancientCode = ucwords($id);
        } else {
            $ancientCode = $id;
        }

        $droidxui = deviceController::remoteData('https://sourceforge.net/projects/droidxui-releases/files/' . $id . '/');
        if (!$droidxui) {
            $droidxui = deviceController::remoteData('https://sourceforge.net/projects/droidxui-releases/files/' . $id . '/');
            $droidxuiCode = ucwords($id);
        } else {
            $droidxuiCode = $id;
        }


        $crdroid = deviceController::remoteData('https://crdroid.net/' . $id . '/10');
        $crdroid_v = 10;
        if (!$crdroid) {
            $crdroid = deviceController::remoteData('https://crdroid.net/' . $id . '/9');
            $crdroid_v = 9;
            if (!$crdroid) {
                $crdroid = deviceController::remoteData('https://crdroid.net/' . $id . '/8');
                $crdroid_v = 8;
                if (!$crdroid) {
                    $crdroid = deviceController::remoteData('https://crdroid.net/' . $id . '/7');
                    $crdroid_v = 7;
                    if (!$crdroid) {
                        $crdroid = deviceController::remoteData('https://crdroid.net/' . $id . '/6');
                        $crdroid_v = 6;
                    }
                }
            }
        }
        return view('customroms', ['devices' => [
            'Pixel Experiance' => [
                'url' => 'https://get.pixelexperience.org/' . $id,
                'boolean' => $pixelExperiance
            ],
            'Pixelos' => [
                'url' => 'https://pixelos.net/download/' . $id,
                'boolean' => $pixelos
            ],
            'Crdroid' => [
                'url' => 'https://crdroid.net/' . $id . '/' . $crdroid_v,
                'boolean' => $crdroid
            ],
            'Evolution X' => [
                'url' => 'https://evolution-x.org/device/' . $id,
                'boolean' => $evolutionx
            ],
            'Baikalos' => [
                'url' => 'https://sourceforge.net/projects/baikalos/files/' . $baikalosCode . '/',
                'boolean' => $baikalos
            ],
            'Hyper OS' => [
                'url' => 'https://xiaomifirmwareupdater.com/hyperos/' . $id . '/',
                'boolean' => $hyperos
            ],
            'Superior OS' => [
                'url' => 'https://sourceforge.net/projects/superioros/files/' . $superiorosCode . '/',
                'boolean' => $superioros
            ],
            'Lineage OS' => [
                'url' => 'https://wiki.lineageos.org/devices/' . $id . '/',
                'boolean' => $lineageos
            ],
            'Project Matrixx' => [
                'url' => 'https://sourceforge.net/projects/projectmatrixx/files/Android-14/' . $projectmatrixxCode . '/',
                'boolean' => $projectmatrixx
            ],
            'Ancient OS' => [
                'url' => 'https://sourceforge.net/projects/ancientrom/files/' . $ancientCode . '/',
                'boolean' => $ancientrom
            ],
            'DroidX UI' => [
                'url' => 'https://sourceforge.net/projects/droidxui-releases/files/' . $droidxuiCode . '/',
                'boolean' => $droidxui
            ],
        ], 'id' => $id]);
    }
    // $ursl = 'https://pixelos.net/download/' . $id;
}



// class deviceController extends Controller
// {
//     public function show($id)
//     {
//         $url = 'https://get.pixelexperience.org/'.$id;
//         $client = new Client();
//         try {
//             $crawler = $client->request('GET', $url);
//             $title = $crawler->filterXPath('//title')->text();
//             return view('customroms', ['title' => $title, 'id' => $id]);
//         } catch (\Exception $e) {
//             return view('customroms', ['title' => 'error', 'id' => $id]);
//         }
//     }
// }
