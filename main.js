window.addEventListener('load', timeIt);

let t = 180;

function timeIt() {
	setTimeout(counter, 180000);
	setInterval(count, 1000);
}

function counter(){
	document.getElementById('submit').disabled = true;
}

function count(){
	 t = t-1;
	document.getElementById('timeLeft').innerHTML = t;	
}