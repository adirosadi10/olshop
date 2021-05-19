<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ongkir extends CI_Controller
{
  private $api_key = 'a71986044741f0002de6c72c99e5f2a4';

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_admin');
  }

  public function provinsi()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        // Silahkan gunakan api key masing masing dari raja ongkir
        "key: $this->api_key"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      // Hasilnya dalam bentuk json
      // kita koversi ke array
      // echo $response;
      $array_response = json_decode($response, TRUE);
      $dataprovinsi = $array_response['rajaongkir']['results'];

      echo "<option value=''>-Pilih provinsi--</option>";

      foreach ($dataprovinsi as $key => $tiap_provinsi) {
        echo "<option value='" . $tiap_provinsi['province_id'] . "' id_provinsi='" . $tiap_provinsi['province_id'] . "'>";
        echo $tiap_provinsi['province'];
        echo "</option>";
      }
    }
  }
  public function distrik()
  {
    $id_provinsi_terpilih = $_POST['id_provinsi'];
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi_terpilih,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        // Silahkan gunakan api key masing masing dari raja ongkir
        "key: $this->api_key"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      // echo $response;
      // Menjadikan array dari json
      $array_response = json_decode($response, TRUE);
      $data_distrik = $array_response['rajaongkir']['results'];


      echo "<option value=''>--Pilih distrik--</option>";

      foreach ($data_distrik as $key => $tiap_distrik) {
        echo "<option value='' id_distrik='" . $tiap_distrik['city_id'] . "' nama_provinsi='" . $tiap_distrik['province'] . "' nama_distrik='" . $tiap_distrik['city_name'] . "' tipe_distrik='" . $tiap_distrik['type'] . "' kodepos='" . $tiap_distrik['postal_code'] . "'>";
        echo $tiap_distrik['type'] . " ";
        echo $tiap_distrik['city_name'];
        echo "</option>";
      }
    }
  }
  public function ekspedisi()
  {
    echo '<option value="">--Pilih ekspedisi--</option>';
    echo '<option value="pos">Pos Indonesia</option>';
    echo '<option value="tiki">TIKI</option>';
    echo '<option value="jne">JNE</option>';
  }
  public function paket()
  {
    $asal = $this->m_admin->data_setting()->lokasi;
    $ekspedisi = $this->input->post('ekspedisi');
    $distrik = $this->input->post('distrik');
    $berat = $this->input->post('berat');

    // $query = mysqli_query($koneksi, "SELECT ");
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=$asal&destination=$distrik&weight=$berat&courier=$ekspedisi",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        // Silahkan gunakan api key masing masing dari raja ongkir
        "key: $this->api_key"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      // Dijadikan ke array
      $array_response = json_decode($response, TRUE);

      $paket = $array_response['rajaongkir']['results']['0']['costs'];


      echo "<option value=''>--Pilih paket--</option>";

      foreach ($paket as $key => $tiap_paket) {
        echo "<option paket='" . $tiap_paket['service'] . "' ongkir='" . $tiap_paket['cost']['0']['value'] . "' etd='" . $tiap_paket['cost']['0']['etd'] . "'>";
        echo $tiap_paket['service'] . " ";
        echo "Rp." . number_format($tiap_paket['cost']['0']['value']) . ",- ";
        echo $tiap_paket['cost']['0']['etd'];
        echo "</option>";
      }
    }
  }
}
