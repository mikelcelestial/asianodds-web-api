<!--JAVASCRIPT HERE-->
<script>
$(document).ready(function () {
	$('#feed_table').DataTable({
		"ajax":"scripts/games.php",
			"columns": [
				{ "data": "Sports" },
				{ "data": "Match ID" },
				{ "data": "Match" },
				{ "data": "Score" },
				{ "data": "Schedule" },
				{ "data": "Odds" },
				{ "data": "League" },
				{ "data": "Game Status" },
				{ "data": "Place Bet?" },
				{ "data": "Share",
				  "orderable": false,
				  "render": function(data){return '<a href="'+data+'"><span class="glyphicon glyphicon-share">Facebook</span></a>'}},
				{ "data": "Twitter",
				  "orderable": false,
				  "render": function(data){return '<a href="'+data+'"><span class="glyphicon glyphicon-share">Twitter</span></a>'}}
			]
	});
});
</script>