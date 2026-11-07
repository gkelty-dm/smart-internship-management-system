@extends('layouts.skydash-admin')

@section('title', 'Edit Perusahaan')

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
                <h4 class="card-title">Edit Data Perusahaan</h4>
                <p class="card-description">Perbarui informasi perusahaan dan sesuaikan titik koordinat pada peta.</p>

                <form class="forms-sample" method="POST" action="{{ route('perusahaan.update', $perusahaan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_perusahaan">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="form-control" 
                                       value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" 
                                       value="{{ old('email', $perusahaan->email) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $perusahaan->alamat) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control" 
                                       value="{{ old('telepon', $perusahaan->telepon) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="radius_absensi">Radius Absensi (Meter)</label>
                                <input type="number" name="radius_absensi" id="radius_absensi" class="form-control" 
                                       value="{{ old('radius_absensi', $perusahaan->radius_absensi) }}" min="10">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Lokasi Perusahaan</label>
                        <div id="map"></div>
                        <button type="button" id="btnLokasi" class="btn btn-outline-success btn-sm">
                            <i class="mdi mdi-crosshairs-gps"></i> Update ke Lokasi Saat Ini
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" name="latitude" id="latitude" class="form-control bg-light" 
                                       value="{{ old('latitude', $perusahaan->latitude) }}" readonly required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" name="longitude" id="longitude" class="form-control bg-light" 
                                       value="{{ old('longitude', $perusahaan->longitude) }}" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Update Data</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const lat = {{ $perusahaan->latitude ?? 3.5952 }};
        const lng = {{ $perusahaan->longitude ?? 98.6722 }};
        const map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);

        const marker = L.marker([lat, lng], { draggable: true }).addTo(map);

        function updateInputs(lat, lng) {
            document.getElementById('latitude').value = lat.toFixed(6);
            document.getElementById('longitude').value = lng.toFixed(6);
        }

        marker.on('dragend', function(e) { updateInputs(marker.getLatLng().lat, marker.getLatLng().lng); });
        map.on('click', function(e) { marker.setLatLng(e.latlng); updateInputs(e.latlng.lat, e.latlng.lng); });

        L.Control.geocoder({ defaultMarkGeocode: false }).on('markgeocode', function(e) {
            map.setView(e.geocode.center, 17);
            marker.setLatLng(e.geocode.center);
            updateInputs(e.geocode.center.lat, e.geocode.center.lng);
        }).addTo(map);

        document.getElementById('btnLokasi').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(pos) {
                    const latlng = [pos.coords.latitude, pos.coords.longitude];
                    map.setView(latlng, 17);
                    marker.setLatLng(latlng);
                    updateInputs(latlng[0], latlng[1]);
                });
            }
        });

        setTimeout(() => { map.invalidateSize(); }, 200);
    });
</script>
@endsection