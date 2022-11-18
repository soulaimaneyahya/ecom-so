<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#textarea-desc-ckeditor' ))
        .catch( error => {
            console.error( error );
        } );
</script>