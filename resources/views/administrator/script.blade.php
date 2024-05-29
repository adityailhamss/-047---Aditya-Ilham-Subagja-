<script src="{{ asset('extensions/apexcharts/apexcharts.min.js') }}"></script>

<script>
  $(function () {
    let url = "{{ route('api.v1.borrowings.statistics') }}";
    let barChart = null;
    let pieChart = null;

    function initCharts() {
      $.ajax({
        url: url,
        data: {
          year: new Date().getFullYear(),
        },
        success: function (res) {

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

            barChart = new ApexCharts(
              document.querySelector("#chart-borrowing-by-year"),
              borrowingsThisYear
            );
            barChart.render();
          } else {
            console.error('Statistics data is missing or empty');
          }

          if (res.commodity_data && Object.keys(res.commodity_data).length > 0) {
            let commodityLabels = Object.keys(res.commodity_data);
            let commodityCounts = Object.values(res.commodity_data);

            let borrowingsPieChart = {
              chart: {
                type: "pie",
                height: 200,
              },
              series: commodityCounts,
              labels: commodityLabels,
              colors: ["#435ebe", "#f54291", "#91f542", "#42f5e9", "#f5e942", "#f5425d", "#42f554", "#f58242", "#42bff5", "#9242f5", "#f542d4", "#f54275"],
            };

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

      if (barChart) {
        barChart.updateSeries([
          {
            data: newData,
          },
        ]);
      }

      if (pieChart) {
        let commodityLabels = Object.keys(data.commodity_data);
        let commodityCounts = Object.values(data.commodity_data);

        pieChart.updateSeries(commodityCounts);
        pieChart.updateOptions({
          labels: commodityLabels,
        });
      }
    }

    initCharts();

    $("#year").keypress(function (e) {
      if (e.keyCode === 13) {
        $.ajax({
          url: url,
          data: {
            year: $("#year").val(),
          },
          success: function (res) {
            $("#card-chart-borrowing-title").text(
              `Peminjaman Tahun ${$("#year").val()}`
            );

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
