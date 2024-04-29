
<!-- Required vendors -->
<script src="vendor/global/global.min.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="js/custom.min.js"></script>
    
<!-- Chart Morris plugin files -->
<script src="vendor/raphael/raphael.min.js"></script>
<script src="vendor/morris/morris.min.js"></script>
    

<!-- Chart piety plugin files -->
<script src="vendor/peity/jquery.peity.min.js"></script>

    <!-- Demo scripts -->
<script src="js/dashboard/dashboard-2.js"></script>

<!-- Svganimation scripts -->
<script src="vendor/svganimation/vivus.min.js"></script>
<script src="vendor/svganimation/svg.animation.js"></script>
<script src="js/styleSwitcher.js"></script>

<!-- Data Table -->
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="js/plugins-init/datatables.init.js"></script>

<!-- Sweet Alert -->
<script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="js/plugins-init/sweetalert.init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>