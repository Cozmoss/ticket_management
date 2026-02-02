document.addEventListener("DOMContentLoaded", function () {
	if (!window.statusChartData) return;
	const ctx = document.getElementById("statusChart").getContext("2d");
	const statusLabels = window.statusChartData.labels;
	const statusValues = window.statusChartData.values;
	const statusColors = window.statusChartData.colors;

	const chart = new Chart(ctx, {
		type: "doughnut",
		data: {
			labels: statusLabels,
			datasets: [
				{
					data: statusValues,
					backgroundColor: statusColors,
					borderWidth: 2,
				},
			],
		},
		options: {
			rotation: -90,
			circumference: 180,
			layout: {
				padding: 0,
			},
			plugins: {
				legend: { display: false },
				title: { display: false },
			},
		},
	});

	// Génère la légende manuellement
	let legendHtml = '<div class="uk-flex uk-flex-wrap uk-flex-left" style="gap:10px;">';
	statusLabels.forEach(function (label, i) {
		legendHtml +=
			'<div class="uk-flex uk-flex-middle uk-flex-center">' +
			'<span style="display:inline-block;width:14px;height:14px;background:' +
			statusColors[i] +
			';margin-right:5px;border-radius:3px;"></span>' +
			'<span style="font-weight:500;">' +
			label +
			"</span>" +
			'<span style="color:#888;margin-left:4px;">(' +
			statusValues[i] +
			")</span>" +
			"</div>";
	});
	legendHtml += "</div>";
	document.getElementById("statusLegend").innerHTML = legendHtml;

	if (legendDiv) legendDiv.innerHTML = legendHtml;
});
