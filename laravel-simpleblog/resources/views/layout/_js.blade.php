<script src="mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="mazer/dist/assets/js/bootstrap.bundle.min.js"></script>

<script src="mazer/dist/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="mazer/dist/assets/js/pages/dashboard.js"></script>

<script src="mazer/dist/assets/js/main.js"></script>
<script src="mazer/dist/assets/vendors/simple-datatables/simple-datatables.js"></script>
<script>
    // Simple Datatable
    let table1 = document.querySelector('#table1');
    let dataTable = new simpleDatatables.DataTable(table1);
</script>
{{-- <script src="mazer/dist/assets/vendors/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}
{{-- beda --}}
    <script src="mazer/dist/assets/vendors/tinymce/tinymce.min.js"></script>
    <script src="mazer/dist/assets/vendors/tinymce/plugins/code/plugin.min.js"></script>
    <script>
        // tinymce.init({ selector: '#default' });
        tinymce.init({ selector: '#dark', toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code', plugins: 'code' });
    </script>
