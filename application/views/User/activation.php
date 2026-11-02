      <link href="<?php echo base_url('AppAjax/notify.css'); ?>" rel="stylesheet">

      <div class="p-4">
          <div class="row g-4">
              <div class="col-lg-6">
                  <div class="card border-0 shadow-sm rounded-4">
                      <div class="card-body p-4">
                          <h6 class="fw-semibold mb-4"><i class="bi bi-shield-lock me-2"></i><?php echo $header; ?></h6>
                            <p><?= currency.format($balance); ?></p>
                          <form
                              id="activationForm"
                              data-ajax="true"
                              action="<?= base_url('activationAjax') ?>"
                              method="POST">
                              <input
                                  type="hidden"
                                  name="<?= $this->security->get_csrf_token_name(); ?>"
                                  value="<?= $this->security->get_csrf_hash(); ?>">

                              <div class="mb-3">
                                  <label class="form-label">User ID</label>
                                  <input
                                      type="text"
                                      name="user_id"
                                      id= "user_id"
                                      class="form-control"
                                      placeholder="Enter User ID"
                                      required>
                              </div>
                              <span id="user_message"></span>

                              <?php if (activation == 0) { ?>
                                  <div class="mb-3">
                                      <label class="form-label">Activation Amount</label>
                                      <input
                                          type="number"
                                          name="amount"
                                          class="form-control"
                                          placeholder="Enter Amount"
                                          min="1"
                                          step="any"
                                          required>
                                  </div>
                              <?php } else { ?>
                                  <div class="mb-3">
                                    <label class="form-label">Select Package</label>

                                      <select name="amount" class="form-control">
                                          <?php 
                                          foreach ($package as $pac) { ?>
                                          <option value="<?php echo $pac['package']; ?>"><?php echo $pac['package_name']; ?> - <?php echo currency.$pac['package']; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>

                              <?php } ?>

                              <button
                                  type="submit"
                                  id="activationBtn"
                                  class="btn btn-success w-100 py-2 fw-semibold">
                                  Activation
                              </button>

                          </form>



                      </div>
                  </div>
              </div>

          </div>
      </div>
      </div>
      <script src="<?php echo base_url('AppAjax/notify.js') ?>"> </script>
      <script src="<?php echo base_url('AppAjax/ajax.js') ?>"></script>