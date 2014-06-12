function getrandom() 
{ 
	var min_random = 0;
	var max_random = 2000;
	
	max_random++;
	
	var range = max_random - min_random;
	var n=Math.floor(Math.random()*range) + min_random;
	
	return n;
}