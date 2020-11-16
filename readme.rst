1- Index.php will load while call http://localhost/paypal_disputes . 
first index.php will call a list dispute list from https://api.sandbox.paypal.com/v1/customer/disputes?page_size=?&start_time=?
with 50 page_size and 7 days last start time through ajax.php with php curl. I add dispute list data in datatable through add.row, it's help to improve speed

2- I have save a token in json file. there is no need to call api for token on each request. It will also help to improve speed

3- on page load or on date change ajax.php will call

4- after gets a list of disputes we show the results but we need to show won or lost with a previous specific time, so we need to call dispute list from https://api.sandbox.paypal.com/v1/customer/disputes/? through ajax2.php. I called here curl multi request to teken less time.

5- we can call  https://api.sandbox.paypal.com/v1/customer/disputes?page_size=?&start_time=? and https://api.sandbox.paypal.com/v1/customer/disputes/? together but response will be late. So i called first dispute list then dispute list which is resolved.

6- I put jquery code in code.js. here we call ajax on page load, on chnage or custom date submit. also i put here constion to call dispute details api call through ajax.php