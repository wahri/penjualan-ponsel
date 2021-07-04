<?php $this->load->view('theme/t_head'); ?>
<?php $this->load->view('theme_kasir/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>
<div class="right_col" role="main">
	<div class="">
		<div class="row">
			<div class="col-xs-12 invoice-header">
				<h1><i class="fa fa-rss"></i> <?php echo $title; ?> </h1>
			</div>
		</div>
		<div class="x_title"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_content">
					<div id="echart_line" style="height:350px;"></div>
				</div>
			</div>
		</div>
		
	</div>
</div>
<!-- ECharts -->
<script src="<?php echo base_url('public/echarts/dist/echarts.min.js'); ?>"></script>
<script src="<?php echo base_url('public/echarts/map/js/world.js'); ?>"></script>
<!-- Flot -->
<script>
	$(document).ready(function() {
	
	var theme = {
	    color: [
	        '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
	        '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
	    ],
	
	    title: {
	        itemGap: 8,
	        textStyle: {
	            fontWeight: 'normal',
	            color: '#408829'
	        }
	    },
	
	    dataRange: {
	        color: ['#1f610a', '#97b58d']
	    },
	
	    toolbox: {
	        color: ['#408829', '#408829', '#408829', '#408829']
	    },
	
	    tooltip: {
	        backgroundColor: 'rgba(0,0,0,0.5)',
	        axisPointer: {
	            type: 'line',
	            lineStyle: {
	                color: '#408829',
	                type: 'dashed'
	            },
	            crossStyle: {
	                color: '#408829'
	            },
	            shadowStyle: {
	                color: 'rgba(200,200,200,0.3)'
	            }
	        }
	    },
	
	    dataZoom: {
	        dataBackgroundColor: '#eee',
	        fillerColor: 'rgba(64,136,41,0.2)',
	        handleColor: '#408829'
	    },
	    grid: {
	        borderWidth: 0
	    },
	
	    categoryAxis: {
	        axisLine: {
	            lineStyle: {
	                color: '#408829'
	            }
	        },
	        splitLine: {
	            lineStyle: {
	                color: ['#eee']
	            }
	        }
	    },
	
	    valueAxis: {
	        axisLine: {
	            lineStyle: {
	                color: '#408829'
	            }
	        },
	        splitArea: {
	            show: true,
	            areaStyle: {
	                color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
	            }
	        },
	        splitLine: {
	            lineStyle: {
	                color: ['#eee']
	            }
	        }
	    },
	    timeline: {
	        lineStyle: {
	            color: '#408829'
	        },
	        controlStyle: {
	            normal: {color: '#408829'},
	            emphasis: {color: '#408829'}
	        }
	    },
	
	    k: {
	        itemStyle: {
	            normal: {
	                color: '#68a54a',
	                color0: '#a9cba2',
	                lineStyle: {
	                    width: 1,
	                    color: '#408829',
	                    color0: '#86b379'
	                }
	            }
	        }
	    },
	    map: {
	        itemStyle: {
	            normal: {
	                areaStyle: {
	                    color: '#ddd'
	                },
	                label: {
	                    textStyle: {
	                        color: '#c12e34'
	                    }
	                }
	            },
	            emphasis: {
	                areaStyle: {
	                    color: '#99d2dd'
	                },
	                label: {
	                    textStyle: {
	                        color: '#c12e34'
	                    }
	                }
	            }
	        }
	    },
	    force: {
	        itemStyle: {
	            normal: {
	                linkStyle: {
	                    strokeColor: '#408829'
	                }
	            }
	        }
	    },
	    chord: {
	        padding: 4,
	        itemStyle: {
	            normal: {
	                lineStyle: {
	                    width: 1,
	                    color: 'rgba(128, 128, 128, 0.5)'
	                },
	                chordStyle: {
	                    lineStyle: {
	                        width: 1,
	                        color: 'rgba(128, 128, 128, 0.5)'
	                    }
	                }
	            },
	            emphasis: {
	                lineStyle: {
	                    width: 1,
	                    color: 'rgba(128, 128, 128, 0.5)'
	                },
	                chordStyle: {
	                    lineStyle: {
	                        width: 1,
	                        color: 'rgba(128, 128, 128, 0.5)'
	                    }
	                }
	            }
	        }
	    },
	    gauge: {
	        startAngle: 225,
	        endAngle: -45,
	        axisLine: {
	            show: true,
	            lineStyle: {
	                color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
	                width: 8
	            }
	        },
	        axisTick: {
	            splitNumber: 10,
	            length: 12,
	            lineStyle: {
	                color: 'auto'
	            }
	        },
	        axisLabel: {
	            textStyle: {
	                color: 'auto'
	            }
	        },
	        splitLine: {
	            length: 18,
	            lineStyle: {
	                color: 'auto'
	            }
	        },
	        pointer: {
	            length: '90%',
	            color: 'auto'
	        },
	        title: {
	            textStyle: {
	                color: '#333'
	            }
	        },
	        detail: {
	            textStyle: {
	                color: 'auto'
	            }
	        }
	    },
	    textStyle: {
	        fontFamily: 'Arial, Verdana, sans-serif'
	    }
	};
	
	
	
	
	var d = new Date();
    var n = d.getFullYear();
	var echartLine = echarts.init(document.getElementById('echart_line'), theme);
	
	echartLine.setOption({
	  title: {
	    text: 'Data Penjualan',
	    subtext: n
	  },
	  tooltip: {
	    trigger: 'axis'
	  },
	  legend: {
	    x: 220,
	    y: 40,
	    data: ['Order', 'Cancel', 'Deal']
	  },
	  toolbox: {
	    show: true,
	    feature: {
	      magicType: {
	        show: true,
	        title: {
	          line: 'Line',
	          bar: 'Bar',
	          stack: 'Stack',
	          tiled: 'Tiled'
	        },
	        type: ['line', 'bar', 'stack', 'tiled']
	      },
	      restore: {
	        show: true,
	        title: "Restore"
	      },
	      saveAsImage: {
	        show: true,
	        title: "Save Image"
	      }
	    }
	  },
	  calculable: true,
	  xAxis: [{
	    type: 'category',
	    boundaryGap: false,
	    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	  }],
	  yAxis: [{
	    type: 'value'
	  }],
	  series: [{
	    name: 'Deal',
	    type: 'line',
	    smooth: true,
	    itemStyle: {
	      normal: {
	        areaStyle: {
	          type: 'default'
	        }
	      }
	    },
	    data: <?php echo json_encode($selesai); ?>
	  }, {
	    name: 'Order',
	    type: 'line',
	    smooth: true,
	    itemStyle: {
	      normal: {
	        areaStyle: {
	          type: 'default'
	        }
	      }
	    },
	    data: <?php echo json_encode($proses); ?>
	  }, {
	    name: 'Cancel',
	    type: 'line',
	    smooth: true,
	    itemStyle: {
	      normal: {
	        areaStyle: {
	          type: 'default'
	        }
	      }
	    },
	    data: <?php echo json_encode($batal); ?>
	  }]
	});
	
	
	
	
	
	
	
	  var data1 = [
	    [gd(2012, 1, 1), 17],
	    [gd(2012, 1, 2), 74],
	    [gd(2012, 1, 3), 6],
	    [gd(2012, 1, 4), 39],
	    [gd(2012, 1, 5), 20],
	    [gd(2012, 1, 6), 85],
	    [gd(2012, 1, 7), 7]
	  ];
	
	  var data2 = [
	    [gd(2012, 1, 1), 82],
	    [gd(2012, 1, 2), 23],
	    [gd(2012, 1, 3), 66],
	    [gd(2012, 1, 4), 9],
	    [gd(2012, 1, 5), 119],
	    [gd(2012, 1, 6), 6],
	    [gd(2012, 1, 7), 9]
	  ];
	  $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
	    data1, data2
	  ], {
	    series: {
	      lines: {
	        show: false,
	        fill: true
	      },
	      splines: {
	        show: true,
	        tension: 0.4,
	        lineWidth: 1,
	        fill: 0.4
	      },
	      points: {
	        radius: 0,
	        show: true
	      },
	      shadowSize: 2
	    },
	    grid: {
	      verticalLines: true,
	      hoverable: true,
	      clickable: true,
	      tickColor: "#d5d5d5",
	      borderWidth: 1,
	      color: '#fff'
	    },
	    colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
	    xaxis: {
	      tickColor: "rgba(51, 51, 51, 0.06)",
	      mode: "time",
	      tickSize: [1, "day"],
	      //tickLength: 10,
	      axisLabel: "Date",
	      axisLabelUseCanvas: true,
	      axisLabelFontSizePixels: 12,
	      axisLabelFontFamily: 'Verdana, Arial',
	      axisLabelPadding: 10
	    },
	    yaxis: {
	      ticks: 8,
	      tickColor: "rgba(51, 51, 51, 0.06)",
	    },
	    tooltip: false
	  });
	
	  function gd(year, month, day) {
	    return new Date(year, month - 1, day).getTime();
	  }
	});
</script>
<!-- /Flot -->
<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->