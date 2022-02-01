@push('script')
<script src="{{asset('admin-layout/assets/global/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('admin-layout/assets/global/uikit/js/uikit.min.js') }}"></script>
<script src="{{ asset('admin-layout/assets/global/uikit/js/uikit-icons.min.js') }}"></script>
 @endpush
<div wire:ignore x-data
     x-init="
  tinymce.init({
  path_absolute : '/',
  paste_as_text: true,
  selector: 'textarea.my-editor',
   plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern'
    ],
     valid_elements : '+*[*]',
       extended_valid_elements: '+iframe[width|height|name|align|class|frameborder|allowfullscreen|allow|src|*],' +
      'script[language|type|async|src|charset]' +
      'img[*]' +
      'embed[width|height|name|flashvars|src|bgcolor|align|play|loop|quality|allowscriptaccess|type|pluginspage]' +
      'blockquote[dir|style|cite|class|id|lang|onclick|ondblclick'
      +'|onkeydown|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout'
      +'|onmouseover|onmouseup|title]',
     content_css: ['css/main.css?' + new Date().getTime(),
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                'global/plugins/tinymce/visualblocks/visualblocks.css','global/plugins/tinymce/codesample/css/prism.css'
            ],
     toolbar: 'insertfile undo redo | styleselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | source code',
     directionality : 'rtl',
     language_url : '{{asset("admin-layout/assets/apps/scripts/tinymce/langs/ar.js")}}',
     language: 'ar',
      forced_root_block: false,
         setup: function (editor) {
             editor.on('init change', function () {
              editor.save();
              });

              editor.on('change', function (e) {
               @this.set('{{$attributes['name']}}', editor.getContent(),true);
                });
                 },


  });
">
    <label>{{$attributes['title']}}</label>

    <textarea class="form-control my-editor" id="{{$attributes['id']}}" rows="10" wire:model.defer="{{$attributes['name']}}">
          {{ $slot }}
    </textarea>



</div>
@error($attributes['name'])
<div class="invalid-feedback" style="display: block;">
    {{$message}}
</div>
@enderror