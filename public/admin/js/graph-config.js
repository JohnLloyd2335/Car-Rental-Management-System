
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
                label: '2023',
                data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                borderWidth: 1,
                backgroundColor: "#3751AB",
                borderColor: "#D4D4D4"
            },
            {
                label: '2024',
                data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
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
        labels: ['Automatic', 'Manual'],
        datasets: [
            {
                data: [12, 19],
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
