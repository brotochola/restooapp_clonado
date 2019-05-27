
				var chart = new CanvasJS.Chart("chartContainer", {
					animationEnabled: true,
					theme: "light",
					title:{
						text: "final utn"
					},
					height: '300',
					width:'200',
					axisY:{
						includeZero: false
					},
					data: [{        
						type: "column",       
						dataPoints: [
							{ y: 450 },
							{ y: 414},
							{ y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
							{ y: 460 },
							{ y: 450 },
							{ y: 500 },
							{ y: 480 },
							{ y: 480 },
							{ y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
							{ y: 500 },
							{ y: 480 },
							{ y: 510 }
						]
					}]
				});
				chart.render();