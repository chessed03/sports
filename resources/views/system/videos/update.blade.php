@extends('template.app')

@section('content')

    <div class="content-header">

        <div class="container-fluid">

            <div class="col-12 d-flex justify-content-between">

                <h1 class="">{{ $submodule }}</h1>

                <ol class="breadcrumb float-sm">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx-fw bx bx-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $module }}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $submodule }}</a></li>
                    <li class="breadcrumb-item active">{{ $location }}</li>
                </ol>

            </div>

        </div>

    </div>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">

                    <div class="card card-default">

                        <div class="card-header">

                            <div class="row justify-content-between">

                                <h6>Editar video</h6>

                                <a href="{{ route('video-index') }}">
                                    <button type="button" class="btn btn-info elevation-2">
                                        <i class="bx bx-fw bx-chevron-left-circle"></i> Regresar
                                    </button>
                                </a>

                            </div>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('video-save-update') }}" method="POST">

                                @csrf

                                <input type="hidden" name="id" id="id" value="{{ $item->id }}">

                                <div class="row">

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="title">Titulo:</label>
                                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ $item->title }}">
                                                @error('title')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="subtitle">Subtitulo:</label>
                                                <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ $item->subtitle }}">
                                                @error('subtitle')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">
                                                <label for="description">Descripción:</label>
                                                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ $item->description }}">
                                                @error('description')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">

                                                <label>Video</label>
                                                <div class="input-group">

                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary btn-file elevation-2 btnFileVideo" onchange="uploadVideo()" data-action="btn-upload" data-input-url="video_url" data-preview-video="video_preview">
                                                            <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar video <input class="hidden" name="upload_video" type="file" id="upload_video">
                                                        </span>
                                                    </label>
                                                    &nbsp;&nbsp;
                                                    <input class="form-control @error('video_url') is-invalid @enderror" name="video_url" readonly="readonly" id="video_url" type="text" value="{{ $item->video_url }}">

                                                    @error('video_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                            </div>

                                            {{--<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                                <div class="row">

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">

                                                        <label for="video_preview">Previsualización del video:</label>
                                                        <div class="embed-responsive embed-responsive-16by9">
                                                            <iframe class="embed-responsive-item" src="" id="video_preview" allowfullscreen></iframe>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>--}}

                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">

                                        <div class="row">

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">

                                                <label>Imágen</label>

                                                <div class="input-group">

                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary btn-file elevation-2 btnFileImage" onchange="uploadImage()" data-action="btn-upload" data-input-url="image_url" data-preview-image="image_preview">
                                                            <i class='bx bx-fw bx-cloud-upload btn-upload'></i> Cargar imagen <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="upload_image" type="file" id="upload_image">
                                                        </span>
                                                    </label>
                                                    &nbsp;&nbsp;
                                                    <input class="form-control @error('image_url') is-invalid @enderror" name="image_url" readonly="readonly" id="image_url" type="text" value="{{ $item->image_url }}">

                                                    @error('image_url')<span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>@enderror
                                                </div>

                                            </div>

                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                                <div class="row">

                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 form-group">

                                                        <label for="image_preview">Previsualización de imágen:</label>

                                                        <img
                                                            src="{{ $item->image_url }}"
                                                            id="image_preview"
                                                            class="w-100 shadow-1-strong rounded mb-4"
                                                            height="340px"
                                                        />

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-12 text-right mt-4">

                                        <a href="{{ route('video-index') }}">
                                            <button type="button" class="btn btn-danger elevation-2 mr-4">
                                                <i class="bx-fw bx bx-x-circle"></i> Cancelar
                                            </button>
                                        </a>

                                        <button type="submit" class="btn btn-success elevation-2"><i class='bx-fw bx bx-save'></i> Guardar</button>

                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection

@section('scripts')

    <script>

        let url_upload_video = '{{ route("multimedia-upload-video") }}';

        let token            = '{{ csrf_token() }}';

        uploadVideo( url_upload_video, token );

        uploadImage( url_upload_video, token );

    </script>

@endsection
