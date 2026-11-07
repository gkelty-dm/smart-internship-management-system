@extends('layouts.admin')

@section('title','Generate Nilai PKL')

@section('content')

<section class="section main-section">

    <div class="mb-6">

        <h1 class="title">
            Generate Nilai PKL
        </h1>

        <p class="text-gray-500">
            Hitung nilai akhir berdasarkan nilai guru dan industri.
        </p>

    </div>

    <div class="card">

        <div class="card-content">

            <form
                method="POST"
                action="{{ route('nilai-pkl.store') }}"
            >

                @csrf

                <div class="field">

                    <label class="label">
                        Siswa PKL
                    </label>

                    <div class="control">

                        <div class="select w-full">

                            <select
                                name="penempatan_pkl_id"
                                required
                            >

                                <option value="">
                                    Pilih Siswa
                                </option>

                                @foreach($penempatans as $item)

                                <option
                                    value="{{ $item->id }}"
                                >

                                    {{ $item->siswa->user->name }}
                                    -
                                    {{ $item->perusahaan->nama_perusahaan }}

                                </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </div>

                <hr>

                <button
                    type="submit"
                    class="button blue"
                >

                    <span class="icon">
                        <i class="mdi mdi-calculator"></i>
                    </span>

                    <span>
                        Hitung Nilai PKL
                    </span>

                </button>

            </form>

        </div>

    </div>

</section>

@endsection