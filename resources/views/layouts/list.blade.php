

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Partner Center
    </title>
    <!-- <link href="./style.css" rel="stylesheet" /> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <link rel="stylesheet" href="style.css">
<!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<style>
     * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; */
        }

        body {
            font-family: 'Montserrat';
            /* background-color: #f8f9fa; */
           
        }

        .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 20px 20px;
      /* border-bottom: 1px solid #ddd; */
    }


    .header-left {
      display: flex;
      align-items: center;
      gap: 50px;
    }

    .header img {
      height: 70px;
      /* margin-right: 20px; */
      top: 10px;
      /* left: 30px; */
      width: 130px;
    }

    .header .nav {
      display: flex;
      gap: 10px;
      /* margin-top: 15px; */
    }

    .header .nav a {
      text-decoration: none;
      /* color: White; */
      border: 1px solid #ddd;
      border-radius: 10px;
      size: 12px;
      width: fixed 100px;
      height: fixed 30px;
      padding-top: 5px;
      padding-right: 22px;
      padding-bottom: 5px;
      padding-left: 22px;
      font-weight: 400;
      line-height: 20px;
      gap: 10px;
      
      letter-spacing: -2%;

    }

    .header .nav a:hover {
      background-color: #28388F;
      color: #fff;
      font-weight: 600;


    }

    .header .icons {
  display: flex;
  align-items: center;
  gap: 5px; /* Adjust this value as needed */
  left: 3rem;
}

.icons img {
  width: 60px; /* Adjust width for consistency */
  height: 60px; /* Adjust height */
}

    /* Wrapper for Icons and Hamburger */
    .header-right {
      display: flex;
      /* gap: 10px; */
      align-items: center;
    }

    /* Hamburger Menu */
    .hamburger {
      display: none;
      /* Hidden on desktop */
      font-size: 24px;
      cursor: pointer;
      background: none;
      border: none;
    }

    /* Drawer (Mobile Navigation) */
    .drawer {
      display: none;
      flex-direction: column;
      background: #fff;
      /* color: #fff; */
      /* Change background to white for a clean look */
      border-left: 2px solid #ddd;
      /* Add left border for separation */
      position: fixed;
      top: 70;
      /* bottom: 0; */
      width: 100%;
      /* Define fixed width for the drawer */
      height: auto;
      z-index: 1000;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    /* When the drawer is active */
    .drawer.active {
      display: flex;
      background-color: #fff;
      /* Show drawer when active */
    }

    .drawer a {
      text-align: center;
      padding: 10px;
      text-decoration: none;
      /* color: white; */

    }

    .drawer a:last-child {
      border-bottom: none;
    }
  

   
    .active{
      color: white;
      background-color: #28388F;
    }

    /* Mobile View Adjustments */
    @media (max-width: 1064px) {
      .header .nav {
        display: none;
        /* Hide desktop nav */
      }

      .header-right {
        display: flex;
        justify-content: flex-end;
        align-items: center;
      }

      .hamburger {
        display: block;
        /* Show hamburger icon */
      }

      /* Selected State */



    }   
 
.container {
    max-width: 95%;
    margin: 0 auto;
    padding: 20px;
    /* border-radius: 8px; */
    border: 1px solid #D2D5DA;
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #28388F;
    font-weight: 600;
}

.table-container {
  border: 1px solid #D2D5DA;
    padding: 1rem;
    /* border-radius: 8px; */
    overflow: hidden; /* Default overflow setting */
    position: relative;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}


td {
    padding: 20px 12px;
    font-size: 14px;
    font-weight: 400;
    line-height: 17.07px;
    color: #27272A;
    border-bottom: 1px solid #F4F4F5;
}

td a{
    text-decoration: none;
    color: #27272A;
}

th {
    background-color: #fff;
    font-weight: 500;
    text-align: left;
    line-height: 17.07px;
    color: #28388F;
    font-size: 14px;
    padding:  12px;
}

tr {
    margin-bottom: 10px;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    background-color: white; /* Background for better visibility */
    position: sticky; /* Stick to the bottom of the table container */
    bottom: 0;
    z-index: 10; /* Ensure it stays above the table content */
    padding: 10px;
    /* border-top: 1px solid #ddd; */
    font-family: "Inter";
}

.pagination a {
    color: black;
    padding: 8px 16px;
    text-decoration: none;
    border: 1px solid #ddd;
    margin: 0 4px;
    border-radius: 4px;
    font-family: "Inter";
}

.pagination a.active {
    background-color: #28388F;
    color: white;
    border: 1px solid #ddd;
    
}

.pagination a:hover:not(.active) {
    background-color: #28388F;
    color: white;
}

.actions i {
    margin-right: 10px;
    cursor: pointer;
}

.actions i:hover {
    color: #007bff;
}

/* Media Query for Mobile View */
@media (max-width: 768px) {
    .table-container {
        overflow-x: auto; /* Enable horizontal scrolling */
    }

    table {
        min-width: 600px; /* Set a minimum width for the table */
    }

    .pagination {
        padding: 5px; /* Reduce padding */
    }

    .pagination a {
        padding: 6px 12px; /* Smaller clickable area */
        font-size: 14px; /* Reduce font size */
    }
}


.thumbnail {
            width: 100px;
          height: 40px;
          object-fit: cover;
          /* border-radius: 4px; */
      }

      .description {
          max-width: 400px;
          line-height: 1.5;
      }

      .share-icon {
          color: #6b7280;
          cursor: pointer;
          padding: 8px;
      }

.back-link {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 14px;
    color: #000000;
    text-decoration: none;
}
</style>
</head>
<body>
@yield('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('asset/js/script.js')}}"></script>
<script>
function deleteConfirm(id, route) {
    // Display confirmation alert
    var confirmDelete = confirm("Are you sure you want to delete this data?");
    if (confirmDelete) {
        window.location.href = route.replace('__ID__', id);
    }
}
</script>
<script>
    $(document).ready(function () {
        $('#partner').change(function () {
            var partnerId = $(this).val();
            $('#partner_center').html('<option value="">Loading...</option>');

            if (partnerId) {
                $.ajax({
                    url: "{{route('admin.get_partner_centers')}}", // Update with your actual API route
                    type: 'GET',
                    data: { partner_id: partnerId },
                    success: function (response) {
                        $('#partner_center').html('<option value="">Choose Partner Center</option>');
                        $.each(response, function (key, value) {
                            $('#partner_center').append('<option value="' + value.id + '">' + value.center_name + '</option>');
                        });
                    },
                    error: function () {
                        $('#partner_center').html('<option value="">No Data Found</option>');
                    }
                });
            } else {
                $('#partner_center').html('<option value="">Choose Partner Center</option>');
            }
        });
    });
</script>
<script>
function toggleSidebar() {
    const drawer = document.getElementById("drawer");
    const body = document.body;
    drawer.classList.toggle("active"); // Toggle the active class on the drawer (menu)
    body.classList.toggle("sidebar-open"); // Optionally, toggle a class on the body for any styling changes

    console.log("Drawer toggle: ", drawer.classList.contains("active"));
}

document.addEventListener("DOMContentLoaded", () => {
    const hamburgerBtn = document.getElementById("hamburger-btn");
    


    if (hamburgerBtn) {
    hamburgerBtn.addEventListener("click", toggleSidebar); // Call toggleSidebar on button click
    } else {
    console.error("Error: 'hamburger-btn' element not found.");
    }
});

</script>
</script>
</body>

</html>