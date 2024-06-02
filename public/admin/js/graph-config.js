
function drawRevenueGraph(lastYearRevenueData, currentYearRevenueData) {
    const revenueByMonthGraph = document.getElementById('revenueByMonthGraph');

    new Chart(revenueByMonthGraph, {
        type: 'bar',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },

            }
        },
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'Septmeber', 'October', 'November', 'December'],
            datasets: [
                {
                    label: (new Date().getFullYear() - 1) + " (Last Year)",
                    data: lastYearRevenueData,
                    borderWidth: 1,
                    backgroundColor: "#3751AB",
                    borderColor: "#D4D4D4"
                },
                {
                    label: new Date().getFullYear() + " (Current Year)",
                    data: currentYearRevenueData,
                    borderWidth: 1,
                    backgroundColor: "#F88D1D",
                    borderColor: "#D4D4D4"
                },
            ]
        },

        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}


function drawCategoryGraph(keys, values) {
    const carCategoryGraph = document.getElementById('carCategoryGraph');

    new Chart(carCategoryGraph, {
        type: 'pie',
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },

            }
        },
        data: {
            labels: keys,
            datasets: [
                {
                    data: values,
                    borderWidth: 1,
                    backgroundColor: ["#3751AB", "#F88D1D"]
                },

            ]
        },

        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}





$(document).ready(function () {

    let token = $("meta[name='token']").attr('content');

    //Get Graph Revenue Data
    $.ajax({
        url: 'getRevenueGraphData',
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (response) {
            let date = new Date();
            let currentYear = date.getFullYear();
            let lastYear = currentYear - 1;

            let currentYearRevenueData = response[currentYear];
            let lastYearRevenueData = response[lastYear];


            drawRevenueGraph(lastYearRevenueData, currentYearRevenueData);

        },
        error: function (error) {
            console.log(error);
        }
    });
    //Get Graph Revenue Data

    //Get Category Graph Data
    $.ajax({
        url: 'getCarCategoryGraphData',
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (response) {

            let keys = Object.keys(response);
            let values = Object.values(response)

            drawCategoryGraph(keys, values);

        },
        error: function (error) {
            console.log(error);
        }
    });
    //Get Category Graph Data




});

