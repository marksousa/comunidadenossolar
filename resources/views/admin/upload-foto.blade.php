@extends('admin.layouts.principal')

@section('page-level-css')
  <link href="{{asset('css/cropper-main.css')}}" rel="stylesheet">
@endsection

@section('conteudo')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          @if(Session::has('mensagem'))
            @component('components.alerta', ['tipo' => Session::get('tipo', 'info'), 'mensagem' => Session::get('mensagem')])
            @endcomponent
          @endif

          <hr class="py-1">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Upload de Foto - {{ $usuario->nome }}</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Teste</a> --}}
          </div>

          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Instruções para o envio de imagens.</h4>
            <ul>
              <li>Clique no botão abaixo.</li>
              <li>Escolha uma imagem.</li>
              <li>Ajuste o quadrado para que realce seu rosto.</li>
              <li>Clique no botão Salvar Imagem.</li>
            </ul>
            <hr>
            <p class="mb-0">Você pode enviar a foto depois. Se não que enviar agora clique no botão ao lado <a href="{{ route('UsuarioShow', ['id' => $usuario->id ]) }}" class="btn btn-sm btn-light">Enviar Depois</a></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="alert text-center font-weight-bolder alert-dismissible alert-primary alert-danger fade show d-none" id="alerta" role="alert" data-dismiss="alert">
          </div>

          <div id="recurso-upload">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <label class="btn btn-primary btn-upload btn-block" for="inputImage" title="Upload image file" id="botao-upload">
                  <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Clique aqui para enviar a imagem">
                      <span class="fa fa-upload"></span>
                    </span>
                    Clique aqui para enviar a imagem
                </label>
              </div>
              <div class="col-md-9 col-sm-12">
                <div class="img-container align-middle d-none">
                  <img src="{{ asset('img/preview.png') }}" alt="Picture" id="img-inicial">
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="docs-preview clearfix invisible">
                  <h5>Previsão:</h5>
                  <div class="img-preview preview-lg"></div>
                </div>
              </div>
            </div>
            <div class="row d-none text-center" id="actions">
              <div class="col-md-12 docs-buttons">

                {{--  Botões Mover e Crop --}}
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Mover a imagem apenas{{-- cropper.setDragMode(&quot;move&quot;) --}}">
                      <span class="fa fa-arrows-alt"></span>
                    </span>
                  </button>
                  {{-- <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                    <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;crop&quot;)">
                      <span class="fa fa-crop-alt"></span>
                    </span>
                  </button> --}}
                </div>

                {{--  Botões de Zoom In e Zoom Out --}}
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Zoom In {{-- cropper.zoom(0.1) --}}">
                      <span class="fa fa-search-plus"></span>
                    </span>
                  </button>
                  <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Zoom Out {{-- cropper.zoom(-0.1) --}}">
                      <span class="fa fa-search-minus"></span>
                    </span>
                  </button>
                </div>

                {{-- Botões para mover a imagem --}}
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Mover para Esquerda{{-- cropper.move(-10,0) --}}">
                      <span class="fa fa-arrow-left"></span>
                    </span>
                  </button>
                  <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Mover para Direita{{-- cropper.move(10,0) --}}">
                      <span class="fa fa-arrow-right"></span>
                    </span>
                  </button>
                  <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Mover para Cima{{-- cropper.move(0,-10) --}}">
                      <span class="fa fa-arrow-up"></span>
                    </span>
                  </button>
                  <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Mover para Baixo{{-- cropper.move(0,10) --}}">
                      <span class="fa fa-arrow-down"></span>
                    </span>
                  </button>
                </div>

                {{-- Girar 90 graus --}}
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate Left">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Girar no Sentido Anti-Horário{{-- cropper.rotate(-90) --}}">
                      <span class="fa fa-undo-alt"></span>
                    </span>
                  </button>
                  <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate Right">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Girar no Sentido Horário{{-- cropper.rotate(90) --}}">
                      <span class="fa fa-redo-alt"></span>
                    </span>
                  </button>
                </div>

                {{--  Girar Horizontalmente e Verticalmente --}}
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Inverter Horizontalmente{{-- cropper.scaleX(-1) --}}">
                      <span class="fa fa-arrows-alt-h"></span>
                    </span>
                  </button>
                  <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Inverter Verticalmente{{-- cropper.scaleY(-1) --}}">
                      <span class="fa fa-arrows-alt-v"></span>
                    </span>
                  </button>
                </div>

                {{--  Refresh e Upload --}}
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Resetar{{-- cropper.reset() --}}">
                      <span class="fa fa-sync-alt"></span>
                    </span>
                  </button>
                  <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                    <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Enviar outra imagem{{-- ImportimagewithBlobURLs --}}">
                      <span class="fa fa-upload"></span>
                    </span>
                  </label>
                </div>

                <div class="row py-2">
                  {{-- Confirmar e Corta a Imagem --}}
                  <div class="btn-group btn-group-crop btn-block">
                    <button type="button" class="btn btn-success" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 472, &quot;height&quot;: 472 }">
                      <span class="docs-tooltip" data-toggle="tooltip" title="Salvar a imagem">
                        Salvar Imagem
                      </span>
                    </button>
                  </div>
                <!-- Mostra a imagem cropada num modal -->
                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="getCroppedCanvasTitle">Deseja salvar essa imagem?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body"></div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        {{-- <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a> --}}
                        <a class="btn btn-primary" href="#" id="salvar-imagem">Salvar</a>
                      </div>
                    </div>
                  </div>
                </div><!-- /.modal -->
                </div>
              </div><!-- /.docs-buttons -->
            </div>
          </div>
@endsection

@section('page-level-scripts')

<script>
  function createAutoClosingAlert(selector, delay) {
    var alert = $(selector).alert();
    window.setTimeout(function() { alert.alert('close') }, delay);
  }
</script>

  <script src="{{ asset('vendor/cropperjs/cropper.min.js') }}"></script>
  <script>
    // prettier-ignore
    window.onload = function() {
      "use strict";

      var Cropper = window.Cropper;
      var URL = window.URL || window.webkitURL;
      var container = document.querySelector(".img-container");
      var image = container.getElementsByTagName("img").item(0);
      // var download = document.getElementById("download");
      var actions = document.getElementById("actions");
      var dataX = document.getElementById("dataX");
      var dataY = document.getElementById("dataY");
      var dataHeight = document.getElementById("dataHeight");
      var dataWidth = document.getElementById("dataWidth");
      var dataRotate = document.getElementById("dataRotate");
      var dataScaleX = document.getElementById("dataScaleX");
      var dataScaleY = document.getElementById("dataScaleY");
      var options = {
          // aspectRatio: 16 / 9,
          aspectRatio: 1 / 1,
          viewMode : 2,
          preview: ".img-preview",
      };
      var cropper = new Cropper(image, options);
      var originalImageURL = image.src;
      var uploadedImageType = "image/jpeg";
      var uploadedImageName = "cropped.jpg";
      var uploadedImageURL;

      // Tooltip
      $('[data-toggle="tooltip"]').tooltip();

      // Buttons
      if (!document.createElement("canvas").getContext) {
          $('button[data-method="getCroppedCanvas"]').prop("disabled", true);
      }

      if (
          typeof document.createElement("cropper").style.transition ===
          "undefined"
      ) {
          $('button[data-method="rotate"]').prop("disabled", true);
          $('button[data-method="scale"]').prop("disabled", true);
      }

      // // Download
      // if (typeof download.download === "undefined") {
      //     download.className += " disabled";
      //     download.title = "Your browser does not support download";
      // }

      // Methods
      actions.querySelector(".docs-buttons").onclick = function(event) {
          var e = event || window.event;
          var target = e.target || e.srcElement;
          var cropped;
          var result;
          var input;
          var data;

          if (!cropper) {
              return;
          }

          while (target !== this) {
              if (target.getAttribute("data-method")) {
                  break;
              }

              target = target.parentNode;
          }

          if (
              target === this ||
              target.disabled ||
              target.className.indexOf("disabled") > -1
          ) {
              return;
          }

          data = {
              method: target.getAttribute("data-method"),
              target: target.getAttribute("data-target"),
              option: target.getAttribute("data-option") || undefined,
              secondOption: target.getAttribute("data-second-option") || undefined
          };

          cropped = cropper.cropped;

          if (data.method) {
              if (typeof data.target !== "undefined") {
                  input = document.querySelector(data.target);

                  if (
                      !target.hasAttribute("data-option") &&
                      data.target &&
                      input
                  ) {
                      try {
                          data.option = JSON.parse(input.value);
                      } catch (e) {
                          console.log(e.message);
                      }
                  }
              }

              switch (data.method) {
                  case "rotate":
                      if (cropped && options.viewMode > 0) {
                          cropper.clear();
                      }

                      break;

                  case "getCroppedCanvas":
                      try {
                          data.option = JSON.parse(data.option);
                      } catch (e) {
                          console.log(e.message);
                      }

                      if (uploadedImageType === "image/jpeg") {
                          if (!data.option) {
                              data.option = {};
                          }

                          data.option.fillColor = "#fff";
                      }

                      break;
              }

              result = cropper[data.method](data.option, data.secondOption);

              switch (data.method) {
                  case "rotate":
                      if (cropped && options.viewMode > 0) {
                          cropper.crop();
                      }

                      break;

                  case "scaleX":
                  case "scaleY":
                      target.setAttribute("data-option", -data.option);
                      break;

                  case "getCroppedCanvas":
                      if (result) {
                        // Bootstrap's Modal
                        $("#getCroppedCanvasModal")
                          .modal()
                          .find(".modal-body")
                          .html(result);

                        // if (!download.disabled) {
                        //   download.download = uploadedImageName;
                        //   download.href = result.toDataURL(uploadedImageType);
                        // }

                        document.getElementById("salvar-imagem").addEventListener("click", function() {
                          var initialAvatarURL;
                          var canvas;
                          $("#getCroppedCanvasModal").modal("hide");
                          canvas = result;
                          var foto = canvas.toDataURL();
                          
                          canvas.toBlob(function (blob) {
                            var formData = new FormData();
                            var _token = $('meta[name="csrf-token"]').attr('content');

                            formData.append('foto', blob, uploadedImageName);
                            formData.append('usuarioId', {{ $usuario->id }});
                            
                            $.ajaxSetup({
                              headers: {
                                  'X-CSRF-TOKEN': _token
                              }
                            });

                            $.ajax('{{ route('FotoStore') }}',{
                              method: 'POST',
                              data: formData,
                              enctype: 'multipart/form-data',
                              processData: false,
                              contentType: false,

                              success: function () {
                                var sucesso = document.querySelector("#alerta");
                                sucesso.textContent = "Foto salva com sucesso!";
                                sucesso.classList.remove('alert-danger');
                                sucesso.classList.remove('d-none');
                                createAutoClosingAlert("#alerta", 2000);
                                cropper.destroy();
                                var principal = document.getElementById("recurso-upload");
                                principal.classList.add("d-none");
                                var url = "{{ route('UsuarioShow', ['id' => $usuario->id]) }}";
                                window.location.replace(url);
                              },
                
                              error: function () {
                                var insucesso = document.querySelector("#alerta");
                                insucesso.textContent = "Houve um erro no envio da foto! Tente novamente.";
                                insucesso.classList.remove('alert-primary');
                                insucesso.classList.remove('d-none');
                              },
                
                              complete: function () {
                                // $progress.hide();
                              },
                            });
                          });
                        });
                      };
                  break;
                  
                  // case "destroy":
                  //     cropper = null;

                  //     if (uploadedImageURL) {
                  //         URL.revokeObjectURL(uploadedImageURL);
                  //         uploadedImageURL = "";
                  //         image.src = originalImageURL;
                  //     }

                  //     break;
              }

              if (typeof result === "object" && result !== cropper && input) {
                  try {
                      input.value = JSON.stringify(result);
                  } catch (e) {
                      console.log(e.message);
                  }
              }
          }
      };

      document.body.onkeydown = function(event) {
          var e = event || window.event;

          if (e.target !== this || !cropper || this.scrollTop > 300) {
              return;
          }

          switch (e.keyCode) {
              case 37:
                  e.preventDefault();
                  cropper.move(-1, 0);
                  break;

              case 38:
                  e.preventDefault();
                  cropper.move(0, -1);
                  break;

              case 39:
                  e.preventDefault();
                  cropper.move(1, 0);
                  break;

              case 40:
                  e.preventDefault();
                  cropper.move(0, 1);
                  break;
          }
      };

      // Import image
      var inputImage = document.getElementById("inputImage");

      if (URL) {
          inputImage.onchange = function() {
              var files = this.files;
              var file;
              
              if (cropper && files && files.length) {
                  file = files[0];

                  if (/^image\/\w+/.test(file.type)) {
                      uploadedImageType = file.type;
                      uploadedImageName = file.name;

                      if (uploadedImageURL) {
                          URL.revokeObjectURL(uploadedImageURL);
                      }

                      image.src = uploadedImageURL = URL.createObjectURL(file);
                      cropper.destroy();
                      cropper = new Cropper(image, options);
                      inputImage.value = null;
                      var imgContainer = document.querySelector(".img-container");
                      imgContainer.classList.remove('d-none');
                      var actions = document.querySelector("#actions");
                      actions.classList.remove('d-none');
                      var botaoUpload = document.querySelector("#botao-upload");
                      botaoUpload.classList.add('d-none');
                      var docsPreview = document.querySelector(".docs-preview");
                      docsPreview.classList.remove('invisible');
                  } else {
                      var erro = document.querySelector("#alerta");
                      erro.textContent = "Por favor, escolha um arquivo de imagem.";
                      erro.classList.remove('alert-primary');
                      erro.classList.remove('d-none');
                      // window.alert("Por favor, escolha um arquivo de imagem.");
                      
                  }
              }
          };
      } else {
          inputImage.disabled = true;
          inputImage.parentNode.className += " disabled";
      }
    };
  </script>
@endsection