<script src="{{ asset('extensions/apexcharts/apexcharts.min.js') }}"></script>

<script>
  // Initiation Function
  $(function () {
    let url = "{{ route('api.v1.borrowings.statistics') }}";  // API endpoint to fetch statistics data
    let barChart = null;  // Variable to hold the bar chart instance
    let pieChart = null;  // Variable to hold the pie chart instance

    // Function to initialize charts
    function initCharts() {
      $.ajax({
        url: url,
        data: {
          year: new Date().getFullYear(),  // Fetch data for the current year
        },
        success: function (res) {
          // Check if data is available in the response
          if (res.data && Object.keys(res.data).length > 0) {
            let data = [
              res.data.jan,
              res.data.feb,
              res.data.mar,
              res.data.apr,
              res.data.mei,
              res.data.jun,
              res.data.jul,
              res.data.agu,
              res.data.sep,
              res.data.okt,
              res.data.nov,
              res.data.des,
            ];

            // Configuration for the bar chart
            let borrowingsThisYear = {
              chart: {
                type: "bar",
                height: 300,
              },
              series: [
                {
                  name: "Peminjaman",
                  data: data,
                },
              ],
              colors: ["#435ebe"],
              xaxis: {
                categories: [
                  "Jan",
                  "Feb",
                  "Mar",
                  "Apr",
                  "Mei",
                  "Jun",
                  "Jul",
                  "Agu",
                  "Sep",
                  "Okt",
                  "Nov",
                  "Des",
                ],
              },
            };

            // Create and render the bar chart
            barChart = new ApexCharts(
              document.querySelector("#chart-borrowing-by-year"),
              borrowingsThisYear
            );
            barChart.render();
          } else {
            console.error('Statistics data is missing or empty');
          }

          // Check if commodity data is available in the response
          if (res.commodity_data && Object.keys(res.commodity_data).length > 0) {
            let commodityLabels = Object.keys(res.commodity_data);
            let commodityCounts = Object.values(res.commodity_data);

            // Configuration for the pie chart
            let borrowingsPieChart = {
              chart: {
                type: "pie",
                height: 200,
                toolbar:{
                  show: true,
                }
              },
              series: commodityCounts,
              labels: commodityLabels,
              colors: ["#435ebe", "#f54291", "#91f542", "#42f5e9", "#f5e942", "#f5425d", "#42f554", "#f58242", "#42bff5", "#9242f5", "#f542d4", "#f54275"],
            };

            // Create and render the pie chart
            pieChart = new ApexCharts(
              document.querySelector("#chart-borrowing-pie"),
              borrowingsPieChart
            );
            pieChart.render();
          } else {
            console.error('Commodity data is missing or empty');
          }
        },
        error: function (xhr, status, error) {
          console.error('Failed to fetch data:', error, xhr.responseText);
        }
      });
    }

    // Function to update chart series with new data
    function updateChartSeries(data) {
      let newData = [
        data.data.jan,
        data.data.feb,
        data.data.mar,
        data.data.apr,
        data.data.mei,
        data.data.jun,
        data.data.jul,
        data.data.agu,
        data.data.sep,
        data.data.okt,
        data.data.nov,
        data.data.des,
      ];

      // Update the bar chart with new data
      if (barChart) {
        barChart.updateSeries([
          {
            data: newData,
          },
        ]);
      }

      // Update the pie chart with new data
      if (pieChart) {
        let commodityLabels = Object.keys(data.commodity_data);
        let commodityCounts = Object.values(data.commodity_data);

        pieChart.updateSeries(commodityCounts);
        pieChart.updateOptions({
          labels: commodityLabels,
        });
      }
    }

    initCharts();  // Initialize charts on page load

    // Event listener for updating charts on 'Enter' key press in the year input field
    $("#year").keypress(function (e) {
      if (e.keyCode === 13) {
        $.ajax({
          url: url,
          data: {
            year: $("#year").val(),  // Fetch data for the entered year
          },
          success: function (res) {
            // Update the chart title with the selected year
            $("#card-chart-borrowing-title").text(
              `Peminjaman Tahun ${$("#year").val()}`
            );

            // Update charts with new data
            updateChartSeries(res);
          },
          error: function (xhr, status, error) {
            console.error('Failed to fetch data:', error, xhr.responseText);
          }
        });
      }
    });
  });
</script>
