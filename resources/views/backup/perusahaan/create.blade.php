@extends('layouts.skydash-admin')

@section('title', 'Tambah Perusahaan')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css"/>

<style>
    #map { height: 400px; width: 100%; border-radius: 5px; margin-bottom: 15px; border: 1px solid #ced4da; }
</style>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Perusahaan Baru</h4>
                <p class="card-description">Lengkapi data detail perusahaan dan tentukan koordinat lokasi pada peta.</p>

                <form class="forms-sample" method="POST" action="{{ route('perusahaan.store') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_perusahaan">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="radius_absensi">Radius Absensi (Meter)</label>
                                <input type="number" name="radius_absensi" id="radius_absensi" value="100" min="10" class="form-control">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Lokasi Perusahaan</label>
                        <div id="map"></div>
                        <button type="button" id="btnLokasi" class="btn btn-outline-success btn-sm">
                            <i class="mdi mdi-crosshairs-gps"></i> Ambil Lokasi Saya
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control bg-light" readonly required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control bg-light" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Simpan Data</button>
                        <a href="{{ route('perusahaan.index') }}" class="btn btn-light">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        let map = L.map('map').setView([3.5952, 98.6722], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        let marker;
        L.Control.geocoder({ defaultMarkGeocode: false }).on('markgeocode', function(e) {
            map.setView(e.geocode.center, 17);
            updateMarker(e.geocode.center);
        }).addTo(map);

        map.on('click', function(e) { updateMarker(e.latlng); });

        function updateMarker(latlng) {
            if(marker) map.removeLayer(marker);
            marker = L.marker(latlng).addTo(map);
            document.getElementById('latitude').value = latlng.lat.toFixed(6);
            document.getElementById('longitude').value = latlng.lng.toFixed(6);
        }

        document.getElementById('btnLokasi').addEventListener('click', function(){
            navigator.geolocation.getCurrentPosition(function(pos) {
                let latlng = {lat: pos.coords.latitude, lng: pos.coords.longitude};
                map.setView(latlng, 17);
                updateMarker(latlng);
            }, function() { alert('Gagal mengambil lokasi GPS'); });
        });
    });
</script>
@endsection