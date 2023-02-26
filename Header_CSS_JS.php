<!-- jQuery -->
<script type="text/javascript" src="boostrap/js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="boostrap/js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="boostrap/js/mdb.min.js"></script>



    <!-- Your custom scripts (optional) -->
    <script type="text/javascript"></script>

    <!-- MDB icon -->
    <!-- <link rel="icon" href="boostrap/img/mdb-favicon.ico" type="image/x-icon"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="boostrap/css/bootstrap.min.css">

    <link type="stylesheet" src="css/compiled-4.19.1.min.css">

    
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="boostrap/css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="boostrap/css/style.css">

    <!-- MDBootstrap Datatables  -->
    <link href="boostrap/css/addons/datatables.min.css" rel="stylesheet">

    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="boostrap/js/addons/datatables.min.js"></script>

    <script>
    $(document).ready(function () {
    $('#dtBasicExample').DataTable({
    // "paging": false, // false to disable pagination (or any other option)
    "ordering": false, // false to disable sorting (or any other option)

  });
  $('.dataTables_length').addClass('bs-select');
});

</script>

<style>
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }
</style>

<style>
    #response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
    text-align: center;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
    text-align: center;
}

div#response.display-block {
    display: block;
}
</style>

<style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, ;
        }

        .header {
            background-color: #f1f1f1;
            padding: 20px 10px;
            height: 90px;
        }

        .header a {
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 9px;
            border-radius: 50px;
        }

        .header a.logo {
            font-size: 15px;
            font-weight: bold;
        }

        .header a:hover {
            background-color: #ddd;
            color: black;
        }

        .header a.active {
            background-color: dodgerblue;
            color: white;
        }

        .header-right {
            float: right;
        }

        @media screen and (max-width: 500px) {
            .header a {
                float: none;
                display: block;
                text-align: left;
            }

            .header-right {
                float: none;
            }
        }

        .dropbtn {
            background-color: #B0C4DE;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            text-align: left;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #4682B4;
        }

        .input-default {
            padding: .3rem .5rem;
            border-radius: 3px;
            border: 1px solid gray;
            outline: none !important;
        }

        .input-default:focus {
            border-color: #1e90ff;
        }

        div.a {
            text-align: center;

        }
    </style>

