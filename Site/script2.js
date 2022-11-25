const twoWeeksAgo = 10 * 24 * 60 * 60 * 1000;
let dateElement = document.querySelector('#date');
dateElement.min = new Date(Date.now() - twoWeeksAgo).toISOString().split('T')[0];
dateElement.max = new Date().toISOString().split('T')[0];