<template>
  <div class="">
    <div class="border rounded  ">
      <div class="h-[calc(100vh-4rem)]">
        <DataTable ref="dt" :value="activations" @row-dblclick="doubleClick" v-model:selection="selectActive" selectionMode="single" dataKey="id" :paginator="true" scrollHeight="flex" :scrollable="true" scrollDirection="both" showGridlines stripedRows class="p-datatable-sm text-xs" style="font-size:12px !important" :rows="40" paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown" :rowsPerPageOptions="[40, 100, 500]" currentPageReportTemplate="Showing {first} to {last} of {totalRecords}">
          <template #header>
            <div class="flex justify-between items-center">
              <div class="text-left flex space-x-2  items-center">
                <div class="text-left text-lg">Activations</div>
                <div class="py-1">
                  <InputText placeholder="Search" type="text" />
                </div>
              </div>
              <div class="flex space-x-2">
                <Button label="Export" icon="pi pi-file-excel" class="p-button-secondary p-button-sm" iconPos="left" @click="exportCSV($event)" />
                <Button label="Add" icon="pi pi-plus" class="p-button-sm p-button-info" iconPos="left" @click="openDialog" />
              </div>
            </div>
          </template>
          <Column selectionMode="multiple" headerStyle="width: 3rem" style="flex-grow: 0; flex-basis: 50px;"></Column>
          <Column field="company_name" header="Company Name" style="flex-grow: 1; flex-basis: 150px;"></Column>
          <Column field="number_product" header="Number Product" style="flex-grow: 1; flex-basis: 200px;"></Column>
          <Column field="phone" header=" Phone" style="flex-grow: 1; flex-basis: 200px;"></Column>
          <Column field="email" header=" Email" style="flex-grow: 1; flex-basis: 200px;"></Column>
          <!-- <Column field="details" header="Details" style="flex-grow: 1; flex-basis: 250px;"></Column> -->
          <Column field="is_active" header="Status" style="flex-grow: 0; flex-basis: 100px;">
            <template #body="slot">
              <div class="flex space-x-2">
                <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded-full" v-if="slot.data.is_active == '0'">Inactive</span>
                <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-200 text-green-700 rounded-full" v-if="slot.data.is_active == '1'">Active</span>
              </div>
            </template>
          </Column>
          <!-- <Column header="Actions" style="flex-grow: 0; flex-basis: 100px;" alignFrozen="right" :frozen="true">
            <template #body="slot">
              <div class="flex space-x-2">
                <Button icon="pi pi-file-edit" class="p-button-sm p-button-info" @click="edit(slot.data.id)" />
                <Button icon="pi pi-trash" class="p-button-sm p-button-danger" @click="destroy(slot.data.id)" />
              </div>
            </template>
          </Column> -->
        </DataTable>
      </div>
      <!-- DIALOG SIDEBAR ----------------------------------------------------------------------------------------------------------- -->
      <Sidebar v-model:visible="showDialog" position="full">
        <ScrollPanel style="width: 100%;" class="h-[calc(100vh-6rem)] custom ">
          <div class="px-2">
            <div>
              <div class="text-lg font-bold py-2 top-0 fixed">Activation</div>
              <div class="grid grid-cols-6 gap-2 py-2">
                <div class="col-span-2">
                  <div class="text-md font-semibold p-1">Company Name</div>
                  <Dropdown v-model="activation.customer_id" :options="customers" optionLabel="company_name" optionValue="id" placeholder="select company " class="w-full" :disabled="activation.id != null" />
                </div>
                <div>
                  <div class="text-md font-semibold p-1">Is Active</div>
                  <Dropdown v-model="activation.is_active" :options="status" optionLabel="name" optionValue="code" placeholder="status" class="w-full" />
                </div>
              </div>
              <div>
                <div class="h-[400px]">
                  <DataTable ref="dt" :value="activation.activation_line" editMode="cell" @cell-edit-complete="onCellEditComplete" class="editable-cells-table p-datatable-sm text-xs" dataKey="id" :paginator="false" scrollHeight="flex" :scrollable="true" scrollDirection="both" showGridlines stripedRows style="font-size:12px !important" :rows="10" paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown" :rowsPerPageOptions="[10, 20, 50]" currentPageReportTemplate="Showing {first} to {last} of {totalRecords}">
                    <template #header>
                      <div class="flex justify-between items-center">
                        <div>
                          <div class="text-left flex space-x-2  items-center" v-show="activation.id != null">
                            <Button label="Contact List" icon="pi pi-id-card" class="p-button-success p-button-sm" iconPos="left" :disabled="activation.id == null" />
                            <Button label="History " icon="pi pi-history" class="p-button-sm p-button-help" iconPos="left" :disabled="activation.id == null" />
                            <Button label="Company Detail" icon="pi pi-list" class="p-button-secondary p-button-sm" iconPos="left" :disabled="activation.id == null" />
                          </div>
                        </div>
                        <div class="flex space-x-2">
                          <Button label="Add" icon="pi pi-plus" class="p-button-sm p-button-info" iconPos="left" @click="addRowActivatonLine" />
                        </div>
                      </div>
                    </template>
                    <Column header="#" style="flex-grow: 0; flex-basis: 50px;" alignFrozen="right" :frozen="true">
                      <template #body="slot">
                        <div class="flex space-x-2 items-center justify-center w-full">
                          {{ slot.index + 1 }}
                        </div>
                      </template>
                    </Column>
                    <!-- <Column selectionMode="multiple" headerStyle="width: 3rem" style="flex-grow: 0; flex-basis: 50px;"></Column> -->
                    <Column field="product_id" header="Product" style="flex-grow: 1; flex-basis: 300px;">
                      <template #body="{ data, field }">
                        <Dropdown v-model="data[field]" :options="products" optionLabel="name" optionValue="id" placeholder="Product" class="w-full" autofocus />

                      </template>
                    </Column>
                    <Column field="user_no" header="User No." style="flex-grow: 0; flex-basis: 220px;">
                      <template #body="{ data, field }">
                        <div class="p-inputgroup">
                          <span class="p-inputgroup-addon p-button-sm">
                            <i class="pi pi-user"></i>
                          </span>
                          <InputText v-model="data[field]" autofocus class="w-full" />
                        </div>
                      </template>
                    </Column>
                    <Column field="term_id" header=" Term" style="flex-grow: 1; flex-basis: 250px;">
                      <template #body="slot">
                        <Dropdown v-model="slot.data.term_id" :options="terms" @change="changeDate(slot.index, slot.data.term_id, 'activated', false)" optionLabel="name" optionValue="id" placeholder="Term" class="w-full" autofocus />
                      </template>
                    </Column>
                    <Column field="period" header=" Period" style="flex-grow: 1; flex-basis: 200px;">
                      <template #body="slot">
                        <InputText v-model="slot.data.period" autofocus @keyup="changeDate(slot.index, slot.data.term_id, '', true)" @change="changeDate(slot.index, slot.data.term_id, '', true)" class="w-full" type="number" :disabled="slot.data.term_id < 5" />
                      </template>
                    </Column>
                    <Column field="activated_date" header="Activated Date" style="flex-grow: 1; flex-basis: 250px;">
                      <template #body="slot">
                        <Calendar inputId="icon" v-model="slot.data.activated_date" @date-select="changeDate(slot.index, slot.data.term_id, 'activated', false)" :showIcon="false" autofocus class="w-full" dateFormat="dd-M-yy" />
                      </template>
                    </Column>
                    <Column field="expired_date" header="Expired Date" style="flex-grow: 1; flex-basis: 250px;">
                      <template #body="slot">
                        <Calendar inputId="icon" v-model="slot.data.expired_date" :showIcon="false" @date-select="changeDate(slot.index, slot.data.term_id, 'expired', false)" autofocus class="w-full" dateFormat="dd-M-yy" />
                      </template>
                    </Column>
                    <Column field="Status" header="Status" style="flex-grow: 0; flex-basis: 100px;">
                      <template #body="slot">
                        <div class="flex space-x-2 w-full">
                          <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded-full" v-if="slot.data.is_active == '0'">Inactive</span>
                          <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-200 text-green-700 rounded-full" v-if="slot.data.is_active == '1'">Active</span>
                        </div>
                      </template>
                    </Column>
                    <Column field="is_free" header="Is Free" style="flex-grow: 1; flex-basis: 100px;">
                      <template #body="{ data, field }">
                        <Checkbox v-model="data[field]" :binary="true" falseValue="0" trueValue="1" />
                      </template>
                    </Column>
                    <Column header="Actions" style="flex-grow: 0; flex-basis: 80px;" alignFrozen="right" :frozen="true">
                      <template #body="slot">
                        <div class="flex space-x-2 items-center justify-center w-full">
                          <Button icon="pi pi-ellipsis-v" class="p-button-rounded p-button-secondary p-button-text" @click="optionAction(slot.index)" />
                        </div>
                      </template>
                    </Column>
                  </DataTable>
                </div>
                <div class="grid grid-cols-3 gap-4">
                  <!-- NOTE ATTACHMENT FILE ----------------------------------------------------------------------------------------- -->
                  <div class="col-span-2">
                    <Panel header="Attachment File" :toggleable="true" :collapsed="activation.id == null" :disabled="activation.id == null">
                      <template #icons>
                        <Menu id="config_menu" ref="menu" :model="items" :popup="true" />
                      </template>
                      <ScrollPanel style="width: 100%; height: 280px">
                        <div class="grid grid-cols-3 w-full h-full gap-4">
                          <div class="w-full">
                            <Textarea class="w-full" rows="10" placeholder="Notes" v-model="activation.details" />
                          </div>
                          <div class="col-span-2">
                            <div class=" px-2">
                              <div class="w-full ">
                                <div class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-gray-400 bg-gray-100 flex justify-center items-center">
                                  <div class="absolute">
                                    <div class="flex flex-col items-center">
                                      <i class="pi-folder-open pi  text-gray-500" style="font-size: 2rem"></i>
                                      <span class="block text-gray-400 font-normal">Attach you files here</span>
                                    </div>
                                  </div>
                                  <input type="file" class="h-full w-full opacity-0" name="">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </ScrollPanel>
                    </Panel>
                  </div>
                  <!-- NOTE ATTACHMENT FILE ----------------------------------------------------------------------------------------- -->
                  <!-- CHAT NOTES ------------------------------------------------------------------------------------------------------ -->
                  <div class="">
                    <Panel header="Subscription notes " :toggleable="true" :collapsed="activation.id == null" :disabled="activation.id == null">
                      <template #icons>
                        <Menu id="config_menu" ref="menu" :model="items" :popup="true" />
                      </template>
                      <ScrollPanel style="width: 100%;height: 280px; ">
                        <div class=" p-2">
                          <div class="bg-teal-50 rounded-b text-teal-900 px-4 py-3 shadow" role="alert">
                            <div class="flex">
                              <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                </svg></div>
                              <div>
                                <p class="font-bold">Our privacy policy has changed</p>
                                <p class="text-sm">Make sure you know how these changes affect you.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" p-2">
                          <div class="bg-teal-50 rounded-b text-teal-900 px-4 py-3 shadow" role="alert">
                            <div class="flex">
                              <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                </svg>
                              </div>
                              <div>
                                <p class="font-bold">Our privacy policy has changed</p>
                                <p class="text-sm">Make sure you know how these changes affect you.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" p-2">
                          <div class="bg-teal-50 rounded-b text-teal-900 px-4 py-3 shadow" role="alert">
                            <div class="flex">
                              <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                </svg>
                              </div>
                              <div>
                                <p class="font-bold">Our privacy policy has changed</p>
                                <p class="text-sm">Make sure you know how these changes affect you.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </ScrollPanel>
                    </Panel>
                  </div>
                  <!-- CHAT NOTES ------------------------------------------------------------------------------------------------------ -->
                </div>
              </div>
            </div>
            <div class="w-full flex justify-end bottom-[10px] right-[10px] fixed ">
              <Button label="Cancel" icon="pi pi-times" @click="cancel" class="p-button-text p-button-secondary" />
              <Button label="Save" icon="pi pi-check" @click="createORupdateProduct" autofocus class="p-button-info" />
            </div>
          </div>
        </ScrollPanel>
      </Sidebar>
      <!-- DIALOG SIDEBAR ----------------------------------------------------------------------------------------------------------- -->
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex"
import * as moment from "moment";
export default {
  components: { mapGetters, moment },
  data() {
    return {
      showDialog: false,
      selectActive: {},
      status: [
        { name: 'Active.', code: '1' },
        { name: 'Inactive.', code: '0' },
      ],
      dataCompany: [],
    }
  },
  computed: {
    ...mapGetters({
      activations: 'activation/activations',
      activation: 'activation/activation',
      activationLine: 'activation/activationLine',
      customers: 'customer/customers',
      products: 'product/products',
      terms: 'activation/terms'
    })
  },
  mounted() {
    this.$store.dispatch('activation/GET_ACTIVATION');
    this.$store.dispatch('customer/GET_CUSTOMER');
    this.$store.dispatch('product/GET_PRODUCT');
  },
  methods: {
    //DOUBLE CLICK 
    doubleClick() {
      this.$store.dispatch('activation/GET_ID_ACTIVATION', this.selectActive.id).then(respnse => {
        if (respnse) {
          this.showDialog = true
        }
      })
    },
    //EDIT 
    edit(id) {
      this.$store.dispatch('activation/GET_ID_ACTIVATION', id).then(respnse => {
        if (respnse) {
          this.showDialog = true
        }
      })
    },
    destroy(id) {
      this.$confirm.require({
        target: event.currentTarget,
        message: 'Are you sure you want to proceed?',
        icon: 'pi pi-exclamation-triangle',
        accept: () => {
          this.$store.dispatch('activation/DESTROY_ACTIVATION', id).then(respnse => {
            if (respnse) {
              this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Deleted successfully', life: 3000 });
            }
          })
        },
        reject: () => {
          this.$toast.add({ severity: 'info', summary: 'Infomation Message', detail: 'Rejected', life: 3000 });
        }
      });

    },
    cancel() {
      this.showDialog = false;
      this.$store.commit('activation/ADD_ACTIVATION')
    },
    //CREATE OR UPDATED
    createORupdateProduct() {
      // UPDATED
      if (this.activation.id != null) {
        this.$store.dispatch('activation/UPDATE_ACTIVATION').then(respnse => {
          if (respnse) {
            this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Updated successfully', life: 3000 });
            this.showDialog = false
          }
        }).catch(error => {
          this.$toast.add({ severity: 'error', summary: 'Error Message', detail: error, life: 3000 });
        })
        // CREATED
      } else {
        this.$store.dispatch('activation/CREATE_ACTIVATION').then(respnse => {
          if (respnse) {
            this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Created successfully', life: 3000 });
            this.showDialog = false
          }
        }).catch(error => {
          this.$toast.add({ severity: 'error', summary: 'Error Message', detail: error, life: 3000 });
        })
      }
    },
    //EXPORT TO EXCEL
    exportCSV() {
      this.$refs.dt.exportCSV();
    },
    // CREATE NEW
    openDialog() {
      this.showDialog = true;
      this.$store.commit('activation/ADD_ACTIVATION')
    },
    // FUNCTION CHANGE 
    changeDate(index, term_id, type, period) {
      this.activation.activation_line.forEach((data, i) => {
        // CHECK IS ROW ACTIVATIONLINE
        if (index == i) {
          //IF PERIOD == FALSE
          if (!period) {
            //IF TYPE == ACTIVATED
            if (type == "activated") {
              // IF ACTIVATED NOT NULL ON CHANGE TERM OR CHANGE EXPIRED DATE
              if (data.activated_date != null && data.activated_date != '') {
                switch (term_id) {
                  case "1":
                    data.period = 1;
                    var ac = data.activated_date;
                    data.expired_date = moment(ac).add(1, "month").format("DD-MMM-YYYY");
                    break;
                  case "2":
                    // 3 Months
                    data.period = 3;
                    var ac = data.activated_date;
                    data.expired_date = moment(ac).add(3, "month").format("DD-MMM-YYYY");
                    break;
                  case "3":
                    // 6 Months
                    data.period = 6;
                    var ac = data.activated_date;
                    data.expired_date = moment(ac).add(6, "month").format("DD-MMM-YYYY");
                    break;
                  case "4":
                    // Year
                    data.period = 12;
                    var ac = data.activated_date;
                    data.expired_date = moment(ac).add(1, "year").format("DD-MMM-YYYY");
                    break;
                  default:
                    // Custom
                    break;
                }
                // IF EXPIRED NOT NULL ON CHANGE TERM OR CHANGE ACTIVATED DATE
              } else if (data.expired_date != null && data.expired_date != '') {
                switch (term_id) {
                  case "1":
                    data.period = 1;
                    var ex = data.expired_date;
                    data.activated_date = moment(ex).subtract(1, "month").format("DD-MMM-YYYY");
                    break;
                  case "2":
                    // 3 Months
                    data.period = 3;
                    var ex = data.expired_date;
                    data.activated_date = moment(ex).subtract(3, "month").format("DD-MMM-YYYY");
                    break;
                  case "3":
                    // 6 Months
                    data.period = 6;
                    var ex = data.expired_date;
                    data.activated_date = moment(ex).subtract(6, "month").format("DD-MMM-YYYY");
                    break;
                  case "4":
                    // Year
                    data.period = 12;
                    var ex = data.expired_date;
                    data.activated_date = moment(ex).subtract(1, "year").format("DD-MMM-YYYY");
                    break;
                  default:
                    // Custom
                    break;
                }
              }
              //IF TYPE == EXPIRED
            } else if (type == "expired") {
              switch (term_id) {
                case "1":
                  data.period = 1;
                  var ex = data.expired_date;
                  data.activated_date = moment(ex).subtract(1, "month").format("DD-MMM-YYYY");
                  break;
                case "2":
                  // 3 Months
                  data.period = 3;
                  var ex = data.expired_date;
                  data.activated_date = moment(ex).subtract(3, "month").format("DD-MMM-YYYY");
                  break;
                case "3":
                  // 6 Months
                  data.period = 6;
                  var ex = data.expired_date;
                  data.activated_date = moment(ex).subtract(6, "month").format("DD-MMM-YYYY");
                  break;
                case "4":
                  // Year
                  data.period = 12;
                  var ex = data.expired_date;
                  data.activated_date = moment(ex).subtract(1, "year").format("DD-MMM-YYYY");
                  break;
                default:
                  // Custom
                  break;
              }
            }
            //IF PERIOD == TRUE
          } else {
            data.term_id = "5";
            var per = data.period
            var ac = data.activated_date;
            var ex = data.expired_date;
            if (per != '' && per != null) {
              if (ac != '' && ac != null) {
                data.expired_date = moment(ac).add(per, "month").format("DD-MMM-YYYY");
              } else {
                if (ex != '' && ex != null) {
                  data.activated_date = moment(ex).subtract(per, "month").format("DD-MMM-YYYY");
                }
              }
            }
          }
        }
      });
    },
    // ADD NEW ROW LINE
    addRowActivatonLine() {
      this.$store.commit('activation/ADD_ACTIVATION_LINE')
    },
    optionAction() {
      alert("hi")
    },
  }
}
</script>
<style>
.custom .p-scrollpanel-bar {
  background-color: rgb(135, 132, 132);
  opacity: 1;
  transition: background-color 0.3s;
}

.custom .p-scrollpanel-bar:hover {
  background-color: #135ba1;
}
</style>