// temporary disable 

const labels = [
    'Jan 8',
    'Jan 9',
    'Jan 10',
    'Jan 11',
    'Jan 12',
    'Jan 13',
    'Jan 14'
  ];

  const data = {
    labels: labels,
    
    datasets: [{
        label: 'Number of Approved Applicant ',
      backgroundColor: 'rgb(0,100,0)',
      borderColor: 'rgb(255, 99, 132)',
      data: [19812,12000,22423,14321,23381,5522,16225,1442],
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
        tension: {
        duration: 1000,
        easing: 'linear',
        from: 1,
        to: 0,
        loop: true
      }
    },
    scales: {
      y: { // defining min and max so hiding the dataset does not change scale range
        min: 0,
        max: 24000
      }
    }
  };
  console.log('this is working');