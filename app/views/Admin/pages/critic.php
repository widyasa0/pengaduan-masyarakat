<?php //var_dump($data['critics']); die(); ?>
<div class="col-lg-10 col-12 content-wrapper ">
    <div class="container">
        <div class=" mt-5">

            <!-- Page Heading -->
            <div class="d-flex flex-row justify-content-between mb-3">
                <h1 class="h3 mb-2 text-gray-800">Critcs Table</h1>
            </div>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Citizen Table</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Sender</th>
                                <th>Critics</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            <?php $i=1;?>
                            <?php foreach( $data['critics'] as $critic) :?>

                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$critic['name']?></td>
                                    <td><?=$critic['critic']?></td>
                                    <td><?=$critic['date']?></td>
                                    <td>
                                        <button type="button" class="btn text-white addData" data-bs-toggle="modal" data-bs-target="#addModal" data-id="<?=$critic['id_critics']?>"  style="background-color:var(--primary-color);">
                                             Feedback
                                        </button>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
     aria-hidden="true" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-body p-5">
                <p class="fs-3 text-center">Give Feedback</p>
                <form action="<?=BASEURL?>critics/store" method="post">
                    <input type="hidden" name="id_critics" id="id_critics">
                    <div class="row gy-4 pt-4">
                        <div class="pt-3 col-12 input-modal w-100">
                            <label>Feedback</label>
                            <div class="input-text-wrapper w-100 mt-2">
                                <textarea type="text" name="feedback" class="w-100 input-text-wrapper border-0" placeholder="Input Feedback" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center gap-3 pt-4">
                        <button type="reset" class="btn btn-modal-close" data-bs-dismiss="modal">Cancel Save</button>
                        <button type="submit" class="btn btn-modal-enter">Give Feedback </button>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


