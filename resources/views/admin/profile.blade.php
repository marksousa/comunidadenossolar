@extends('admin.layouts.principal')

@section('page-level-css')

@endsection

@section('conteudo')

  {{-- Estilos relacionados ao cropperjs --}}
  <style>
    .container {
      max-width: 640px;
    }

    img {
      max-width: 100%;
    }

    .cropper-view-box,
    .cropper-face {
      border-radius: 50%;
    }
  </style>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Perfil</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Teste</a>
    </div>

    <!-- Content Row -->
    <div class="row">
      <div class="col-12 col-md-6 col-xl-4">
        <!-- Avatar -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">Avatar</h6>
          </div>
          <div class="card-body">
            <div class="card-text text-center">

            {{--  avatar --}}
            <label class="label" data-toggle="tooltip" title="Altere seu Avatar">
              @if(is_null(Auth::user()->avatar))
              <img class="rounded-circle" id="avatar" src="https://ui-avatars.com/api/?size=160&rounded=true&name={{ Str::replaceFirst(' ','+', Auth::user()->name) }}" alt="avatar">
              @else
              <img class="rounded-circle" id="avatar" src="{{ asset('storage')."/".$user->avatar }}" alt="avatar">
              @endif
              <input type="file" class="sr-only" id="input" name="image" accept="image/*">
            </label>
          
              {{-- barra de progresso --}}
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
              </div>
            
              {{-- alerts para informar sucesso ou nao do upload --}}
            <div class="alert" role="alert"></div>
            
            {{-- modal para o crop --}}
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Corte a imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="img-container">
                      <img id="image" src="https://ui-avatars.com/api/?size=160&rounded=true&name={{ Str::replaceFirst(' ','+', Auth::user()->name) }}">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="crop">Cortar</button>
                  </div>
                </div>
              </div>
            </div>

            <p class="card-text">Nome: {{ $user->name }}</p>
            <p class="card-text">Email: {{ $user->email }}</p>
          </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-8">
        <!-- Infos -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informações</h6>
          </div>
          <div class="card-body">
            <div class="text-center">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Dados Pessoais</a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Contato</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Endereço</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Entrevista</a>
                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Histórico</a>
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                  
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
              </div>
          </div>
        </div>
      </div>
    </div> {{-- fecha row --}}
@endsection

@section('page-level-scripts')
  <script src="{{ asset('vendor/cropperjs/cropper.min.js') }}"></script>
  <script>
    window.addEventListener('DOMContentLoaded', function () {
      avatar = document.getElementById('avatar');
      var image = document.getElementById('image');
      var input = document.getElementById('input');
      var $progress = $('.progress');
      var $progressBar = $('.progress-bar');
      var $alert = $('.alert');
      var $modal = $('#modal');
      var cropper;

      $progress.hide();

      $('[data-toggle="tooltip"]').tooltip();

      input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          input.value = '';
          image.src = url;
          $alert.hide();
          $modal.modal('show');
        };
        var reader;
        // var file; variavel deve ser global
        var url;

        if (files && files.length > 0) {
          file = files[0];

          if (URL) {
            done(URL.createObjectURL(file));
          } else if (FileReader) {
            reader = new FileReader();
            reader.onload = function (e) {
              done(reader.result);
            };
            reader.readAsDataURL(file);
          }
        }
      });
      
      $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
          aspectRatio: 1,
          viewMode: 3,
        });
      }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
      });

      document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
          canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
          });
          initialAvatarURL = avatar.src;

          avatar.src = canvas.toDataURL();
          $progress.show();
          $alert.removeClass('alert-success alert-warning');
          canvas.toBlob(function (blob) {
            var formData = new FormData();
            var _token = $('meta[name="csrf-token"]').attr('content');

            // formData.append('avatar', blob, 'avatar.jpg');
            formData.append('avatar', blob, file["name"]);

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': _token
            }
            });

            $.ajax('{{ route('AvatarStore') }}', {
              method: 'POST',
              data: formData,
              enctype: 'multipart/form-data',
              processData: false,
              contentType: false,

              xhr: function () {
                var xhr = new XMLHttpRequest();

                xhr.upload.onprogress = function (e) {
                  var percent = '0';
                  var percentage = '0%';

                  if (e.lengthComputable) {
                    percent = Math.round((e.loaded / e.total) * 100);
                    percentage = percent + '%';
                    $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage).delay(5000).fadeOut(800);
                  }
                };

                return xhr;
              },

              success: function () {
                $alert.show().addClass('alert-success').text('Imagem Alterada com Sucesso').delay(2500).fadeOut(500);
                $('#top-img-profile').attr('src', avatar.src);
              },

              error: function () {
                avatar.src = initialAvatarURL;
                $alert.show().addClass('alert-warning').text('Erro no Envio. Tente novamente.');
              },

              complete: function () {
                $progress.hide();
              },
            });
          });
        }
      });
    });
  </script>
@endsection