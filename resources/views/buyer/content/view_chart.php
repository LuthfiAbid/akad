
		<!-- HEADER -->
		<?php include 'header.php';?>
		<!-- /HEADER -->

		<!-- SECTION -->

        <style type="text/css">
    #outtable{
        padding: 20px;
        border:1px solid #e3e3e3;
        width:600px;
        border-radius: 5px;
    }

    .short{
        width: 50px;
    }

    .normal{
        width: 150px;
    }
    #aaa_table{
        border-collapse: collapse;
        font-family: arial;
        color:#5E5B5C;
    }

    #aaa_thead th{
        text-align: left;
        padding: 10px;
    }

    #aaa_tbody td{
        border-top: 1px solid #e3e3e3;
        padding: 10px;
    }

    #aaa_tbody tr:nth-child(even){
        background: #F6F5FA;
    }

    #aaa_tbody tr:hover{
        background: #EAE9F5
    }

    #aaa_thead, #aaa_tbody { display: block; }

#aaa_tbody {
    height: 400px;
    width: 100%;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
}
</style>
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
                    <!-- product -->
						<div class="col-md-12">
                        <table class="table" width="100%" style="float: left;" id="aaa_table">
                                    <thead id="aaa_thead">
                                    </thead>
                                    <tbody align="center" id="aaa_tbody">
                                    <tr align="center">
                                    <td width="1%" ><b><font color="">No</font></b></td>
                                    <td width="1%" ><b><font color="">BRGID</font></b></td>
                                    <td width="10%"><b><font color="">Picture</font></b></td>
                                    <td width="10%"><b><font color="">Nama Barang</font></b></td>
                                    <td width="10%"><b><font color="">qty</font></b></td>
                                    <td width="10%"><b>Subtotal</b></td>
                                    <td width="10%"><b>Action</b></td>
                                    </tr>
                                        <tr>
                                        <td>1</td>
                                        <td>BRG1</td>
                                        <td><img height="40%" width="40%" src="./img/wandimor.jpg" alt=""></td>
                                        <td>Wandior</td>
                                        <td><p id="edit" onclick="edit_stok('edit');">1</p></td>
                                        <td>Rp. 200.000</td>
                                        <td><button class="btn btn-danger"><i class="fa fa-close"></i></button></td>
                                        </tr>
                                        <tr>
                                        <td>2</td>
                                        <td>BRG2</td>
                                        <td><img height="40%" width="40%" src="./img/wandimor.jpg" alt=""></td>
                                        <td>Wandior2</td>
                                        <td>2</td>
                                        <td>Rp. 200.000</td>
                                        <td><button class="btn btn-danger"><i class="fa fa-close"></i></button></td>
                                        </tr>
                                        <tr>
                                        <td>1</td>
                                        <td>BRG1</td>
                                        <td><img height="40%" width="40%" src="./img/wandimor.jpg" alt=""></td>
                                        <td>Wandior</td>
                                        <td>1</td>
                                        <td>Rp. 200.000</td>
                                        <td><button class="btn btn-danger"><i class="fa fa-close"></i></button></td>
                                        </tr>
                                </tbody>
                                </table>
                                <h3 align="right">Grand Total Rp. 600.000</h3>
                        </div>
                    <!-- /product -->
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- HOT DEAL SECTION -->
		
		<!-- /HOT DEAL SECTION -->

        <?php include 'footer.php';?>

<script>
function edit_stok(edit) {
    console.log(edit);
    inputIdWithHash = "#" + edit;
    elementValue = $(inputIdWithHash).text();
    $(inputIdWithHash).replaceWith('<input name="test" style="width: 70px;border-radius: 5px;" id="' + edit + '" type="number" value="' + elementValue + '">');

    $(document).click(function (event) {
        var qty = $('#edit').val()
        var edit = 'edit';
        if (!$(event.target).closest(inputIdWithHash).length) {
            $(inputIdWithHash).replaceWith('<p id="' + edit + '" onclick="edit_stok(\'' + edit + '\')">' + qty + '</p>');
        
            $('#edit').val(qty);
        }

    });
}
</script>
