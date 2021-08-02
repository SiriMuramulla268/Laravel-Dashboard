<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../vendors/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../vendors/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../vendors/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<style>
    label.error {
         color: #dc3545;
         font-size: 12px;
    }
</style>
<body>

 <!-- DataTables  & Plugins -->
    <script src="../vendors/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendors/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#adduser").validate({
                rules: {
                    name: "required",
                    email: "required",
                    password: {
                        required: true,
                        minlength: 6
                    },
                    company: "required",
                    mobile: {   
                        required: true,
                        minlength: 10
                    },
                },
                messages: {
                    name: "Name is required",
                    email: "Email is required",
                    password: {
                        required: "Password is required",
                        minlength: "Password must be of 6 digits"
                    },
                    mobile: {
                        required: "Mobile number is required",
                        minlength: "Mobile number must be of 10 digits"
                    },
                    company: "Company is required",
                }
            }); 

            $("#example1").DataTable({
                "responsive": true, 
                "lengthChange": false, 
                "autoWidth": false,
                "paging": false,
                "searching": false,
                "info": false,
                "ordering": true,
            });
        });
        </script>
</body>
</html>