(function(){
	var el = wp.element.createElement;
	var svgIcon = el("svg", {
			xmlns: "http://www.w3.org/2000/svg",
			width: "24px",
			height: "24px",
			viewBox: "0 0 54.391 54.391",
			"xml:space": "preserve"
		},
		el("polygon", {
			fill: "#000",
			points: "0.285,19.392 24.181,49.057 13.342,19.392"
		}),
		el("polygon", {
			fill: "#000",
			points: "15.472,19.392 27.02,50.998 38.795,19.392"
		}),
		el("polygon", {
			fill: "#000",
			points: "29.593,49.823 54.105,19.392 40.929,19.392"
		}),
		el("polygon", {
			fill: "#000",
			points: "44.755,3.392 29.297,3.392 39.896,16.437"
		}),
		el("polygon", {
			fill: "#D44F6D",
			points: "38.094,17.392 27.195,3.979 16.297,17.392"
		}),
		el("polygon", {
			fill: "#000",
			points: "25.094,3.392 9.625,3.392 14.424,16.525"
		}),
		el("polygon", {
			fill: "#000",
			points: "7.959,4.658 0,17.392 12.611,17.392"
		}),
		el("polygon", {
			fill: "#000",
			points: "54.391,17.392 46.424,4.645 41.674,17.392"
		})
	);
	wp.blocks.updateCategory("diamond-template-blocks",{icon:svgIcon});
	$("body").on("click",".acf-block-preview a",function(event){event.preventDefault();});
})();