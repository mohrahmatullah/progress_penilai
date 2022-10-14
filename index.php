<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">

    <title>Progress Penilaian</title>
  </head>
  <body>
    <!--Content Start-->
    <div class="content-start transition  "> 
        <div class="container-fluid dashboard">
          <div class="content-header mt-3 mb-5 text-center">
            <h1>Progress Penilaian</h1>
          </div>
          
          <div class="row match-height">
            <div class="col-lg-12 col-md-12">
              <div class="card border-0">
                <div class="card-content">
                  <div class="card-body">
                    <a type="button" class="btn btn-secondary btn-sm mb-3" id="createModal" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                      <i class="bi bi-journal-plus"></i>
                    </a>
                    <table class="table">
                      <thead class="table table-primary">
                        <tr>
                          <th>No</th>
                          <th class="col-2">Client / Company</th>
                          <th class="col-2">No SPK</th>
                          <th class="col-2">Lokasi</th>
                          <th class="col-1">Penilai</th>
                          <th class="col-2">Tujuan Penilaian</th>
                          <th class="col-1">Status</th>
                          <th class="col-1">Note</th>
                          <th class="col-1">Tools</th>
                        </tr>
                      </thead>
                      <tbody id="table" style="font-size: 14px">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div> 
                 
        </div><!-- End Container-->
    </div><!-- End Content-->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Create Progress</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form class="modal-body" id="form">
            <div class="mb-3">              
              <input type="hidden" name="id" id="id">
              <label for="client" class="form-label">Client / Company</label>
              <input type="text" class="form-control form-control-sm" id="client">
            </div>
            
            <div class="mb-3">
              <label for="no_spk" class="form-label">No SPK</label>
              <input type="text" class="form-control form-control-sm" id="no_spk">
            </div>
            
            <div class="mb-3">
              <label for="lokasi" class="form-label">Lokasi</label>
              <input type="text" class="form-control form-control-sm" id="lokasi">
            </div>
            
            <div class="mb-3">
              <label for="penilai" class="form-label">Penilai</label>
              <input type="text" class="form-control form-control-sm" id="penilai">
            </div>
            
            <div class="mb-3">
              <label for="tujuan_penilai" class="form-label">Tujuan Penilai</label>
              <select class="form-control form-control-sm" id="tujuan_penilai">
                <option value="">--Pilih--</option>
                <option value="Jaminan Utang">Jaminan Utang</option>
                <option value="Transaksi Jual Beli">Transaksi Jual Beli</option>
                <option value="Laporan Keuangan">Laporan Keuangan</option>
                <option value="IPO">IPO</option>
                <option value="Lelang">Lelang</option>
                <option value="Merger">Merger</option>
                <option value="Akuisisi">Akuisisi</option>
                <option value="Asuransi">Asuransi</option>
                <option value="Pendanaan">Pendanaan</option>
                <option value="Internal Management">Internal Management</option>
              </select>
            </div>
            
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-control form-control-sm" id="status">
                <option value="">--Pilih--</option>
                <option value="Schedule">Schedule</option>
                <option value="Inpeksi">Inpeksi</option>
                <option value="Resume">Resume</option>
                <option value="Proses Final">Proses Final</option>
                <option value="Final">Final</option>
                <option value="Prosess Review">Prosess Review</option>
              </select>
            </div>
            
            <div class="mb-3">
              <label for="catatan_progress" class="form-label">Catatan Progress</label>
              <input type="text" class="form-control form-control-sm" id="catatan_progress">
            </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btn-save" onclick="save()">Create</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">

        var modal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});
        var head = document.getElementById('staticBackdropLabel');
        var btn_save = document.getElementById('btn-save');

        allData();
        //method to get all data
        function allData(){
            
            table.innerHTML = ``
            //get data from localstorage and store to contaclist array
            //we must to use JSON.parse, because data as string, we need convert to array
            contactList = JSON.parse(localStorage.getItem('listItem')) ?? []
        
            //looping data and show data in table
            contactList.forEach(function (value, i){
               
                var table = document.getElementById('table')
        
                table.innerHTML += `
                    <tr style="cursor: pointer;">
                        <td><a onclick="find(${value.id})">${i+1}</a></td>
                        <td><a onclick="find(${value.id})">${value.client}</a></td>
                        <td><a onclick="find(${value.id})">${value.no_spk}</a></td>
                        <td><a onclick="find(${value.id})">${value.lokasi}</a></td>
                        <td><a onclick="find(${value.id})">${value.penilai}</a></td>
                        <td><a onclick="find(${value.id})">${value.tujuan_penilai}</a></td>
                        <td><a onclick="find(${value.id})">${value.status}</a></td>
                        <td><a onclick="find(${value.id})">${value.catatan_progress}</a></td>
                        <td>
                          <button class="btn btn-sm btn-success" onclick="find(${value.id})">
                                <i class="bi bi-pencil-square"></i>
                          </button>
                          <button class="btn btn-sm btn-danger" onclick="removeData(${value.id})">
                                <i class="bi bi-trash3"></i>
                          </button>
                        </td>
                    </tr>`
            })
        }

        //method to save data into localstorage
        function save(){
            //get data from localstorage and store to contaclist array
            //we must to use JSON.parse, because data as string, we need convert to array
            contactList = JSON.parse(localStorage.getItem('listItem')) ?? []

            //get last array to get last id
            //and store it into variable id
            var id
            contactList.length != 0 ? contactList.findLast((item) => id = item.id) : id = 0

            if(document.getElementById('id').value){

                //edit contactlist array based on value
                contactList.forEach(value => {
                    if(document.getElementById('id').value == value.id){
                        value.client              = document.getElementById('client').value, 
                        value.no_spk              = document.getElementById('no_spk').value, 
                        value.lokasi              = document.getElementById('lokasi').value, 
                        value.penilai             = document.getElementById('penilai').value,
                        value.tujuan_penilai      = document.getElementById('tujuan_penilai').value,
                        value.status              = document.getElementById('status').value,                        
                        value.catatan_progress    = document.getElementById('catatan_progress').value
                    }
                });

                //remove hidden input
                document.getElementById('id').value = ''

                // hide modal
                modal.hide();
            }else{

                //save
                //get data from form
                var item = {
                    id          : id + 1, 
                    client              : document.getElementById('client').value, 
                    no_spk              : document.getElementById('no_spk').value, 
                    lokasi              : document.getElementById('lokasi').value, 
                    penilai             : document.getElementById('penilai').value,
                    tujuan_penilai      : document.getElementById('tujuan_penilai').value, 
                    status              : document.getElementById('status').value, 
                    catatan_progress    : document.getElementById('catatan_progress').value
                }

                //add item data to array contactlist
                contactList.push(item)

                // hide modal
                modal.hide();
            }

            // save array into localstorage
            localStorage.setItem('listItem', JSON.stringify(contactList))

            //update table list
            allData()

            //remove form data
            document.getElementById('form').reset()


        } 

        //method to get detail personal data based on id
        function find(id){
            modal.show();
            head.innerHTML = 'Edit Progress'
            btn_save.innerHTML = 'Update'
            //get data from localstorage and store to contaclist array
            //we must to use JSON.parse, because data as string, we need convert to array
            contactList = JSON.parse(localStorage.getItem('listItem')) ?? []

            contactList.forEach(function (value){
                if(value.id == id){
                   document.getElementById('id').value = value.id
                   document.getElementById('client').value = value.client
                   document.getElementById('no_spk').value = value.no_spk
                   document.getElementById('lokasi').value = value.lokasi
                   document.getElementById('penilai').value = value.penilai
                   document.getElementById('tujuan_penilai').value = value.tujuan_penilai
                   document.getElementById('status').value = value.status
                   document.getElementById('catatan_progress').value = value.catatan_progress
                }
            })
        }

        function removeData(id){
            //get data from localstorage and store to contaclist array
            //we must to use JSON.parse, because data as string, we need convert to array
            contactList = JSON.parse(localStorage.getItem('listItem')) ?? []
        
            contactList = contactList.filter(function(value){ 
                return value.id != id; 
            });
        
            // save array into localstorage
            localStorage.setItem('listItem', JSON.stringify(contactList))
        
            //get data again
            allData()
        }

        function clearData(){
            document.getElementById('form').reset()
            document.getElementById('id').value = ""
        }

        const createmodal = document.getElementById("createModal");

        createmodal.onclick = function () {
            clearData();
            document.getElementById('form').reset()
            head.innerHTML = 'Create Progress'
            btn_save.innerHTML = 'Save'
        };
    </script>
  </body>
</html>