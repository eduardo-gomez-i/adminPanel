/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./public/js/chartjs/LineChart.js ***!
  \****************************************/
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var LineChart = /*#__PURE__*/function () {
  function LineChart() {
    _classCallCheck(this, LineChart);

    this.init();
  }

  _createClass(LineChart, [{
    key: "init",
    value: function init() {
      this.lineChart();
    }
  }, {
    key: "lineChart",
    value: function lineChart() {
      $.ajax({
        url: '/line-chart',
        method: 'GET',
        success: function success(response) {
          var data = {
            type: 'line',
            data: {
              labels: response.months,
              datasets: [{
                label: 'Beneficios',
                backgroundColor: Looper.colors.brand.purple,
                borderColor: Looper.colors.brand.purple,
                data: response.data,
                fill: false
              }]
            },
            options: {
              title: {
                display: true,
                text: 'Beneficios'
              },
              tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                  label: function label(tooltipItem, data) {
                    var label = "Beneficios: ".concat(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] || '0');

                    if (label) {
                      label += '€';
                    }

                    return label;
                  }
                }
              },
              hover: {
                mode: 'nearest',
                intersect: true
              },
              scales: {
                xAxes: [{
                  ticks: {
                    maxRotation: 0,
                    maxTicksLimit: 5
                  }
                }]
              }
            }
          }; // init chart line

          var canvas = $('#canvas-line-chart')[0].getContext('2d');
          new Chart(canvas, data);
        }
      });
    }
  }]);

  return LineChart;
}();

$(document).ready(function () {
  new LineChart();
});
/******/ })()
;