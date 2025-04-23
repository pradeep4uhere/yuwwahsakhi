

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!-- <link href="./style.css" rel="stylesheet" /> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <link rel="stylesheet" href="style.css">
<!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-geo"></script>

<style>
     * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            /* font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; */
        }

        body {
            /* background-color: #f8f9fa; */
            /* padding: 20px; */
            font-family: 'Montserrat', sans-serif;
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
    border: 1px solid #ddd;
    padding: 5px 15px;
    width: 95%;
    margin: 0 auto;
  }
  .title {
    font-size: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    line-height: 20px;
    letter-spacing: -2px;
  }
  #main_title{
    font-weight: 600;
    font-size: 20px;
    color: rgba(40, 56, 143, 1);
    line-height: 20px;
  }
  
  .date-picker input {
    
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 125px;
    height: 30px;
    gap: 40px;
    background-color: #F5F6F9;
    
  }
  

  input[type="date"]::-webkit-calendar-picker-indicator {
    filter: brightness(0) saturate(100%) invert(26%) sepia(98%) saturate(1781%) hue-rotate(164deg) brightness(93%) contrast(94%);
    cursor: pointer;
  }
  /* Mobile View (Responsive Adjustment) */
  @media (max-width: 768px) {
    .title {
      flex-direction: column; /* Stack the elements vertically */
      align-items: flex-start; /* Align to the start of the container */
      gap: 3rem; /* Add space between stacked items */
      /* padding-bottom: 6rem;     */
    }
  }
  .card {
    padding: 10px;
    border-radius: 5px;
  }
  
  .card .name {
    font-size: large;
    font-weight: normal;
  }
  .card .value {
    font-size: 30px;
    font-weight: 600;
    color: #31bcf1;
    line-height: 46.32px;
  }
  .name-value-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;font-size: 32px;
    margin-left: -10px;
    display: inline-flex; /* Ensures dynamic width and side-by-side layout */
    align-items: center; /* Aligns items vertically */
    border: 1px solid #ddd; /* Border around the entire box */
    padding: 0px 10px; /* Space inside the box */
    border-radius: 10px; /* Rounded corners */
    gap: 20px; /* Space between 'name' and 'value' */
    background-color: #F9F9F9; /* Optional: Background color */

  }
  .name-value-box .name {
    flex: 5;
    text-align: left;
    color: rgba(40, 56, 143, 1);
    font-weight: 500;
    font-size: 16px;
  }
  .name-value-box .value {
    flex: 1;
    text-align: right;
  }
  .chart-container {
    position: relative;
    height: 400px;
    margin-top: 20px;
  }

  .chartjs-plugin-datalabels {
    text-shadow: 0 1px 2px rgba(255,255,255,0.7);
}

  canvas {
    width: 100% !important;
    height: 100% !important;
}

/* Remove these old classes */
.chart, .range, .chart div, .chart div span, .chart div p {
    display: none !important;
}
  .card .range {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    padding-right: 10px;
    height: 300px;
    color: #31bcf1;
  }
  .card .range div {
    font-size: 12px;
    color: #333;
  }
  .chart {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    height: 300px;
    border-left: 1px dotted #ccc;
    border-bottom: 1px dotted #ccc;
    padding: 10px;
    background-color: #fff;
    position: relative;
    flex-grow: 1;
  }
  .chart::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: linear-gradient(
        to right,
        transparent 10%,
        #F5F5F5 10%,
        #F5F5F5 20%,
        transparent 20%
      ),
      linear-gradient(
        to bottom,
        transparent 10%,
        #F5F5F5 10%,
        #F5F5F5 20%,
        transparent 20%
      );
    background-size: 6% 20%;
    z-index: 0;
    border-left: 1px dotted #ccc;
    border-bottom: 1px dotted #ccc;
  }
  .chart div {
    width: 4%;
    background-color: #31bcf1;
    text-align: center;
    color: #333;
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    top: 0.6rem;
    /* border: #ccc solid 1px; */
  }
  .chart div span {
    position: absolute;
    bottom: 100%;
    width: 100%;
    margin-bottom: -35px;
  }
  .chart div p {
    position: absolute;
    bottom: -30px;
    width: 100%;
    margin: 0;
  }
  .chart-name {
    text-align: center;
    margin-top: 40px;
    font-weight: 400;
    font-size: 12px;
  }
  .date-picker {
    display: flex;
    gap: 10px;
    align-items: center;
    /* border: 1px solid #ddd; */
    padding: 10px;
    /* border-radius: 5px; */
  }
  .start-date{
    color: #31bcf1;
    font-size: 14px;
  }
  /* Index.html */
  @media (max-width: 768px) {
    .date-picker {
      width: 100%;
    }
    .card {
      padding: 0px;
    }
    .card h2 {
      /* font-size: 32px; */
      margin-left: -1px;
      margin-bottom: 1em;
    }
    .header .nav {
      flex-direction: column;
      align-items: flex-start;
    }
    .chart-container {
      /* flex-direction: row; */
      height: 350px;
    }
    .chart div {
      width: 100%;
      margin-bottom: 10px;
      .range {
        .range {
          .range {
            align-items: flex-start; /* Aligns content to the left side */
            padding-right: 0; /* Optional: Removes the right padding */
          }
          align-items: flex-start; /* Aligns content to the left side */
          padding-right: 0; /* Optional: Removes the right padding */
        }
        align-items: flex-start; /* Aligns content to the left side */
        padding-right: 0; /* Optional: Removes the right padding */
      }
    }
    .chart div p {
      font-size: 7px;
      /* font-weight: bold; */
      line-height: 1.5;
    }
    .title {
      flex-direction: column;
      align-items: flex-start;
    }
    .range {
      align-items: flex-start;
      padding-right: 0; /* Optional: Removes the right padding */
    }
  }
  .dashboard {
        display: flex;
        justify-content: space-between;
        padding:3rem;
        /* margin-left: 1rem; */
        gap: 20px;
    }
    
    .dashboard {
      display: flex; /* Enables flex layout */
      justify-content: space-between; /* Space between items */
      align-items: center; /* Align items vertically */
      gap: 20px; /* Spacing between sections */
    }
    
    .section {
      flex: 1; /* Ensures all sections take equal width */
      text-align: center; /* Centers the text */
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); */
      height: 450px; /* Matches image height */
      width: 400px; /* Matches image width */
    }
    
    .section:hover {
      /* transform: translateY(-5px);
      transition: all 0.3s ease-in-out; */
      /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); */
    }
    
    .section-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 10px;
      text-align: left;
    }
    
    .donut-chart img {
      width: 260px;
      height: 300px;
      object-fit: cover; /* Ensures the image fits nicely */
      border-radius: 8px; /* Optional: Rounded corners for images */
    }
    


    
    .map {
        margin-top: 20px;
    }
    
    .map-image {
        width: 70%;
        border-radius: 8px;
    }
    
    /* Media query for mobile view */
    @media (max-width: 768px) {
        .dashboard {
        display: block;
        justify-content: space-between;
        padding:0.5rem;
        margin-left:-1rem;
        gap: 20px;
    }
        .section {
            margin-bottom: 20px;
        }
    }

 /* Container */
 .details-container {
    max-width: 90%;
    margin: 30px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    border: 1px solid #ddd;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Title */
.details-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: left;
}

/* Table */
.details-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    text-align: left;
    border: 1px solid #ddd;
}

.details-table thead th {
    padding: 12px;
    background-color: #f4f4f4;
    border-bottom: 2px solid #ddd;
    font-weight: bold;
}

.details-table tbody td {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.details-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.details-table .actions {
    text-align: center;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.pagination-btn {
    padding: 6px 12px;
    margin: 0 5px;
    background-color: #f4f4f4;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
}

.pagination-number {
    padding: 6px 12px;
    margin: 0 2px;
    background-color: #f4f4f4;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
}

.pagination-number.active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.pagination-ellipsis {
    margin: 0 5px;
    color: #888;
}

@media (max-width: 480px) {
    .chart-container {
        height: 300px;
    }
}
</style>
</style>
</head>
<body>
@yield('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="{{asset('asset/js/script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        //Chart.register(ChartDataLabels); // Add this line
        // Common responsive configuration
        const responsiveConfig = (maxY) => ({
            responsive: true,
            maintainAspectRatio: false,
            
            layout: {
                padding: {
                    top: 10,
                    bottom: window.innerWidth < 768 ? 40 : 20
                }
            },
            scales: {
                y: {
                    max: maxY,
                    ticks: {
                        stepSize: 10,
                        color: '#0a0a0a',
                        font: {
                            family: 'Montserrat',
                            size: window.innerWidth < 768 ? 10 : 12
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        borderDash: [5, 5]
                    }
                },
                x: {
                    grid: { display: true },
                    ticks: {
                        autoSkip: true,
                        maxRotation: window.innerWidth < 768 ? 45 : 0,
                        minRotation: window.innerWidth < 768 ? 45 : 0,
                        font: {
                            family: 'Montserrat',
                            size: window.innerWidth < 768 ? 10 : 12
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false,  position: 'top' },
                datalabels: {
                    anchor: 'center',
                    align: 'center',
                    color: 'rgba(0, 0, 0, 0.5)',
                    font: {
                        family: 'Montserrat',
                        weight: 'bold',
                        size: window.innerWidth < 768 ? 10 : 15
                    },
                    formatter: value => value
                }
            }
        });
        const chartsData = @json($chartsData);
        const labels = @json($labels);
        // Initialize all charts with responsive config
        function initializeChart(chartId, data, maxY, labels) {
            new Chart(document.getElementById(chartId), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: '#31bcf1',
                        borderWidth: 1,
                        categoryPercentage: 0.8,
                        barPercentage: 0.9
                    }]
                },
                options: responsiveConfig(maxY),
               
                
            });
        }

        // Initialize charts
        const chartLabels = @json($labels);
        document.addEventListener('DOMContentLoaded', () => {
          initializeChart('partnerCenter', chartsData.partnerCenter, chartsData.partnerCenterMaxY,chartLabels);
          initializeChart('yuwaahChart', chartsData.yuwaahChart, chartsData.yuwaahChartMaxY,chartLabels);
          initializeChart('coursesCompleted', chartsData.coursesCompleted, chartsData.coursesCompletedMaxY,chartLabels);
          initializeChart('opportunitiesVerified', chartsData.opportunitiesVerified, chartsData.opportunitiesVerifiedMaxY,chartLabels);
      });



        //
        const labelsdonut = ['14-20','21-30','31-40','40+'];
        const valuesdonut = [560,340,300,450,100];
        const colorsdonut = ['#13c2c2', '#b83d00','#771166','#52c41a'];
        function createDonutData(labels, values, colors) {
          return {
            labels: labels,
            datasets: [{
              data: values,
              backgroundColor: colors,
              hoverOffset: 4
            }]
          };
        }
        const chartData = createDonutData(labelsdonut, valuesdonut, colorsdonut);
        
        function initializeDonutChart(chartId, doughnut) {
        new Chart(document.getElementById(chartId), {
          type: 'doughnut',
          data: doughnut,
          options: {
          responsive: true,
            animations: {
              tension: {
                duration: 3000,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: true
              }
            },
          plugins: {
            tooltip: {
              callbacks: {
                label: 'Age Group',
              }
            },
            legend: {
              position: 'bottom'
            }
          }
        }
        });
      }
      initializeDonutChart('donutChartId', chartData);



      //Gender

        //
        const genderlabelsdonut = ['Male','Female','Other'];
        const gendervaluesdonut = [560,140,1];
        const gendercolorsdonut = ['#1677ff','#f316a2','#faad14'];
        function createGenderDonutData(labels, values, colors) {
          return {
            labels: labels,
            datasets: [{
              data: values,
              backgroundColor: colors,
              hoverOffset: 4
            }]
          };
        }
        const genderchartData = createGenderDonutData(genderlabelsdonut, gendervaluesdonut, gendercolorsdonut);
        
        function initializeGenderDonutChart(chartId, doughnut) {
        new Chart(document.getElementById(chartId), {
          type: 'doughnut',
          data: doughnut,
          options: {
          responsive: true,
          plugins: {
            tooltip: {
              callbacks: {
                label: 'Age Group',
              }
            },
            legend: {
              position: 'bottom'
            }
          }
        }
        });
      }
      initializeGenderDonutChart('genderdonutChartId', genderchartData);



       //
        const otherlabelsdonut = ['Opportunites','Event'];
        const othervaluesdonut = [560,140];
        const othercolorsdonut = ['#13c2c2','#ffbac6'];
        function createOtherDonutData(labels, values, colors) {
          return {
            labels: labels,
            datasets: [{
              data: values,
              backgroundColor: colors,
              hoverOffset: 4
            }]
          };
        }
        const otherchartData = createOtherDonutData(otherlabelsdonut, othervaluesdonut, othercolorsdonut);
        
        function initializeOtherDonutChart(chartId, doughnut) {
        new Chart(document.getElementById(chartId), {
          type: 'doughnut',
          data: doughnut,
          options: {
          responsive: true,
          plugins: {
            tooltip: {
              callbacks: {
                label: 'Age Group',
              }
            },
            legend: {
              position: 'bottom'
            }
          }
        }
        });
      }
      initializeOtherDonutChart('otherdonutChartId', otherchartData);
      </script>
      <script>
       const labelsLine = getMonthLabels(12);
       
       const dataLine = {
          labels: labelsLine,
          datasets: [
            {
              label: 'Opportiunites', // Label for the first line
              data: [65, 59, 80, 81, 56, 55, 40,59, 80, 81, 56, 55, 40], // First dataset values
              fill: false,
              borderColor: 'rgb(75, 192, 192)', // First line color
              tension: 0.9
            },
            {
              label: 'Events', // Label for the second line
              data: [28, 48, 40, 19, 86, 27, 90,28, 48, 40, 19, 86, 27], // Second dataset values
              fill: false,
              borderColor: 'rgb(255, 99, 132)', // Second line color (different from the first)
              tension: 0.9
            }
          ]
        };


  function initializeLineChart(chartId, dataLine) {
    new Chart(document.getElementById(chartId), {
      type: 'line',
      data: dataLine, // Corrected from 'doughnut' to 'dataLine'
      options: {
        responsive: true,
        animations: {
              tension: {
                duration: 500,
                easing: 'linear',
                from: 1,
                to: 0,
                loop: false
              }
        },
        plugins: {
          tooltip: {
          enabled: true, // Enable tooltips
          callbacks: {
            // Custom tooltip label
              label: function(tooltipItem) {
                // Tooltip formatting to show dataset label and data point value
                return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
              },
              title: function(tooltipItems) {
                // Custom title for tooltip (e.g., show the label of the month)
                return 'Month: ' + tooltipItems[0].label;
              }
            }
          },
          legend: {
            position: 'bottom'
          },
        }
      }
    });
  }
  function getMonthLabels(count) {
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const currentMonth = new Date().getMonth(); // Get the current month
    const labelsArr = [];

    for (let i = 0; i < count; i++) {
      labelsArr.push(months[(currentMonth + i) % 12]);
    }

    return labelsArr;
  }


  initializeLineChart('lineChart', dataLine);
      </script>


<script>
  // Function to generate month labels dynamically (replaces Utils.months)
function getMonthLabels(count) {
  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const currentMonth = new Date().getMonth(); // Get the current month
  const labels = [];

  for (let i = 0; i < count; i++) {
    labels.push(months[(currentMonth + i) % 12]);
  }

  return labels;
}

// Bar chart data configuration
const labelsArr = getMonthLabels(12); // Generate 7 months dynamically
const dataArr = {
  labels: labels,
  datasets: [{
    label: 'Assigned Opportunites',
    data: [65, 59, 80, 81, 56, 55, 40,80, 81, 56, 55, 40],
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

// Method to initialize and render the bar chart
function initializeBarChart(chartId, chartData) {
  const ctx = document.getElementById(chartId).getContext('2d'); // Get the canvas context

  // Check if the context is null
  if (!ctx) {
    console.error("Canvas element not found");
    return;
  }

  new Chart(ctx, {
    type: 'bar', // Bar chart type
    data: chartData, // The data for the chart
    options: {
      responsive: true, // Make the chart responsive
      scales: {
        x: {
          beginAtZero: true // Ensure X-axis starts from 0
        },
        y: {
          beginAtZero: true // Ensure Y-axis starts from 0
        }
      },
      plugins: {
        tooltip: {
          callbacks: {
            // Custom tooltip label
            label: function(tooltipItem) {
              return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
            },
            title: function(tooltipItems) {
              return 'Month: ' + tooltipItems[0].label;
            }
          }
        },
        legend: {
          position: 'bottom'
        }
      }
    }
  });
}

// Call the method to initialize the bar chart
initializeBarChart('barChart', dataArr);
</script>
</body>
</html>