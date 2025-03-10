if(!!(window.addEventListener)) window.addEventListener('DOMContentLoaded', main);
else window.attachEvent('onload', main);

function main() {
    lineChartMes();
    lineChartAno();

}

function lineChartMes(operacao_id, url) {
     
    
    var operacao = operacao_id;
    
    var Httpreq = new XMLHttpRequest(); // a new request
    Httpreq.open("GET", url + '/api/grafico/entregas/mes/' + operacao_id,false);
    Httpreq.send(null);

    var dados = JSON.parse(Httpreq.responseText);
    var meses = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto",'Setembro',"Outubro","Novembro","Dezembro"]

    var data = {
        labels : meses,
        datasets : []
    };


    dados.forEach(function (a, i) {
        data.datasets.push({
            label: a.label,
            fillColor: a.fillColor,
            strokeColor: a.strokeColor,
            pointColor: a.pointColor,
            pointStrokeColor: a.pointStrokeColor,
            data: JSON.parse(a.data)
        });
    });
        

    console.log(data);

    var ctx = document.getElementById("lineChartMes").getContext("2d");
    new Chart(ctx).Line(data);

    legend(document.getElementById("lineLegendMes"), data);
}

function lineChartAno(operacao_id, url) {
     
    
    var operacao = operacao_id;
    
    var Httpreq = new XMLHttpRequest(); // a new request
    Httpreq.open("GET", url + '/api/grafico/entregas/ano/' + operacao_id,false);
    Httpreq.send(null);

    var dados = JSON.parse(Httpreq.responseText);
    var ano = ["2009","2010","2011","2012","2013","2014","2015","2016",'2017',"2018","2019","2020","2021"]

    var data = {
        labels : ano,
        datasets : []
    };


    dados.forEach(function (a, i) {
        data.datasets.push({
            label: a.label,
            fillColor: a.fillColor,
            strokeColor: a.strokeColor,
            pointColor: a.pointColor,
            pointStrokeColor: a.pointStrokeColor,
            data: JSON.parse(a.data)
        });
    });
        

    console.log(data);

    var ctx = document.getElementById("lineChartAno").getContext("2d");
    new Chart(ctx).Line(data);

    legend(document.getElementById("lineLegendAno"), data);
}








//     GRAFICO EXEMPLO
function barsChart() {
    var data = {
        labels : ["January","February","March","April","May","June","July"],
        datasets : [
            {
            fillColor : "rgba(220,220,220,0.5)",
            strokeColor : "rgba(220,220,220,1)",
            pointColor : "rgba(220,220,220,1)",
            pointStrokeColor : "#fff",
            data : [65,59,90,81,56,55,40],
            label : 'Tigers'
        },
        {
            fillColor : "rgba(151,187,205,0.5)",
            strokeColor : "rgba(151,187,205,1)",
            pointColor : "rgba(151,187,205,1)",
            pointStrokeColor : "#fff",
            data : [28,48,40,19,96,27,100],
            label : 'Bears'
        }
        ]
    };

    var ctx = document.getElementById("barsChart").getContext("2d");
    new Chart(ctx).Bar(data);

    legend(document.getElementById("barsLegend"), data);
}
function pieChart() {
    var data = [
        {
            value: 30,
            color:"#F38630",
            label: 'Bears'
        },
        {
            value : 50,
            color : "#E0E4CC",
            label: 'Lynxes'
        },
        {
            value : 100,
            color : "#69D2E7",
            label: 'Reindeer'
        }
    ];

    var ctx = document.getElementById("pieChart").getContext("2d");
    var pieChart = new Chart(ctx).Pie(data);

    legend(document.getElementById("pieLegend"), data, pieChart);
}

function doughnutChart() {
    var data = [
        {
            value: 40,
            color:"#F38630",
            label: 'Animals'
        },
        {
            value : 20,
            color : "#E0E4CC",
            label: 'People'
        },
        {
            value : 30,
            color : "#69D2E7",
            label: 'Aliens'
        }
    ];

    var ctx = document.getElementById("doughnutChart").getContext("2d");
    var doughnutChart = new Chart(ctx).Doughnut(data);

    legend(document.getElementById("doughnutLegend"), data, doughnutChart);
}


function polarArea() {
	var data = [
		{
			value: 300,
			color:"#F7464A",
			highlight: "#FF5A5E",
			label: "Red"
		},
		{
			value: 50,
			color: "#46BFBD",
			highlight: "#5AD3D1",
			label: "Green"
		},
		{
			value: 100,
			color: "#FDB45C",
			highlight: "#FFC870",
			label: "Yellow"
		},
		{
			value: 40,
			color: "#949FB1",
			highlight: "#A8B3C5",
			label: "Grey"
		},
		{
			value: 120,
			color: "#4D5360",
			highlight: "#616774",
			label: "Dark Grey"
		}

	];

	var ctx = document.getElementById("polarChart").getContext("2d");
	var polarChart = new Chart(ctx).PolarArea(data);

	legend(document.getElementById("polarLegend"), data, polarChart);

}


function radarArea() {
	var data = {
		labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
		datasets: [
			{
				label: "My First dataset",
				fillColor: "rgba(220,220,220,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [65,59,90,81,56,55,40]
			},
			{
				label: "My Second dataset",
				fillColor: "rgba(151,187,205,0.2)",
				strokeColor: "rgba(151,187,205,1)",
				pointColor: "rgba(151,187,205,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: [28,48,40,19,96,27,100]
			}
		]
	};

	
	var ctx = document.getElementById("radarChart").getContext("2d");
	var radarChart = new Chart(ctx).Radar(data,{responsive: true});

	legend(document.getElementById("radarLegend"), data, radarChart);
}