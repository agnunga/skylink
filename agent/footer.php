</div>
<footer>
    <div class="row">
        <div class="col-md-12">
            &copy; 2016 Skylink Agencies | By : <a href="" target="_blank">ISAAC MUCHIRI</a>
        </div>

    </div>
</footer>
<!-- end wrapper -->

<!-- Core Scripts - Include with every page 
<script src="../assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/plugins/pace/pace.js"></script>
<script src="assets/scripts/siminta.js"></script>
 Page-Level Plugin Scripts
<script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="assets/plugins/morris/morris.js"></script>
<script src="assets/scripts/dashboard-demo.js"></script>

<script src="../assets/js/jquery-ui.js" type="text/javascript"></script>
<script src="assets/plugins/dataTables/jquery.dataTables.js" type="text/javascript"></script>
<script src="assets/plugins/dataTables/dataTables.bootstrap.js" type="text/javascript"></script>-->

<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
<script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="assets/plugins/pace/pace.js"></script>
<script src="assets/scripts/siminta.js"></script>
<!-- Page-Level Plugin Scripts-->
<script src="assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="../assets/parsley/parsley.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

<script>
    $(document).ready(function () {
        $('.group').hide();
        $('.group').addClass('hidden');
        $('#option1').show();
        $('#selectMe').change(function () {
            $('.group').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>
</body>

</html>