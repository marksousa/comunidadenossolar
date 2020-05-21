@extends('admin.layouts.principal')

@section('page-level-css')
  <link href="{{asset('vendor/cropperjs/cropper.min.css')}}" rel="stylesheet">
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

  <div class="container">
    <h1>Upload cropped image to server</h1>
    <label class="label" data-toggle="tooltip" title="Change your avatar">
      @if(is_null(Auth::user()->avatar))
      <img class="rounded-circle" id="avatar" src="https://ui-avatars.com/api/?size=160&rounded=true&name={{ Str::replaceFirst(' ','+', Auth::user()->name) }}" alt="avatar">
      @else
      <img class="rounded-circle" id="avatar" src="{{ asset('storage')."/".Auth::user()->avatar }}" alt="avatar">
      @endif
      <input type="file" class="sr-only" id="input" name="image" accept="image/*">
    </label>
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
    <div class="alert" role="alert"></div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Crop the image</h5>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="crop">Crop</button>
          </div>
        </div>
      </div>
    </div>
  </div>
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
                    $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                  }
                };

                return xhr;
              },

              success: function () {
                $alert.show().addClass('alert-success').text('Imagem Enviada com Sucesso');
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