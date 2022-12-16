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
      <!-- DIALOG SIDEBAR ------------------------------------------------------------------------------------------------------------->
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
                        <Dropdown v-model="slot.data.term_id" :options="terms" @change="changeDate(slot.index, slot.data.term_id, 'term', false)" optionLabel="name" optionValue="id" placeholder="Term" class="w-full" autofocus />
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
                          <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded-full" v-if="slot.data.status == '0'">New</span>
                          <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-green-200 text-green-700 rounded-full" v-if="slot.data.status == '1'">Active</span>
                          <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-orange-200 text-orange-700 rounded-full" v-if="slot.data.status == '2'">Not Activated</span>
                          <span class="text-[11px] inline-block py-1 px-2.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-red-200 text-red-700 rounded-full" v-if="slot.data.status == '3'">Expired</span>
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
                          <div @click="setActlineId(slot.data.id)" v-if="slot.data.id">
                            <Button icon="pi pi-ellipsis-v" class="p-button-rounded p-button-secondary p-button-text" @click="clickTogle" />
                            <Menu ref="menu_action" :model="itemsAction" :popup="true" class="text-xs" />
                          </div>
                          <div v-else>
                            <Button icon="pi pi-trash" class="p-button-sm p-button-danger" @click="destroyLine(slot.index)" />
                          </div>
                        </div>
                      </template>
                    </Column>
                  </DataTable>
                </div>
                <div class="grid grid-cols-2 gap-4">
                  <!-- NOTE ATTACHMENT FILE ----------------------------------------------------------------------------------------- -->
                  <div class="">
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
                              <div class="w-full">
                                <div class="relative border-dotted h-16 rounded-lg border-dashed border-2 border-gray-400 bg-gray-100 flex justify-center items-center">
                                  <form name="form" id="file-upload" class="flex justify-center items-center">
                                    <div class="absolute">
                                      <div class="flex flex-col items-center">
                                        <i class="pi-folder-open pi  text-gray-500" style="font-size:1.5rem"></i>
                                        <span class="block text-gray-400 font-normal">Attach you files here</span>
                                      </div>
                                    </div>
                                    <input type="text" class="h-full w-full opacity-0" name="activation_id" v-model="activation.id">
                                    <input type="file" class="h-full w-full opacity-0" ref="files" name="files" @change="uploadFile">
                                  </form>
                                </div>
                              </div>
                              <div class="flex flex-col space-y-2 py-2">
                                <div class=" flex space-x-2 text-blue-400" v-for="data in upload_file" :key="data">
                                  <a @click="prewViewDoc(data.file_path)"><i class="pi-folder-open pi  text-blue-400  text-gray-500"></i> <span class="text-blue-400 font-lg">{{ data.name }}</span></a>
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
                      <div class="p-editor-container">
                        <ScrollPanel style="width: 100%; height: 280px">
                          <div class="p-editor-content ql-container ql-snow" style="border:0 !important">
                            <div class="ql-editor">
                              <div>
                                <div class="w-ful flex justify-center items-center" v-if="noteActivation.length == 0">
                                  <div class="shadow rounded-2xl w-42 p-5 bg-white dark:bg-gray-800">
                                    <div class="flex items-center justify-center pb-2">
                                      <span class="">
                                        <i class="pi-eraser pi" style="font-size:30px"></i>
                                      </span>
                                    </div>
                                    <div class="flex flex-col justify-start">
                                      <p class="text-gray-600 text-md text-left dark:text-white font-bold my-4">
                                        No note !
                                      </p>
                                      <div class="relative w-28 h-2 bg-gray-200 rounded">
                                        <div class="absolute top-0 h-2  left-0 rounded bg-green-500 w-2/3">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div v-if="noteActivation.length > 0">
                                  <div class="w-auto flex flex-col " v-for="data in noteActivation" :key="data">
                                    <div class="flex justify-sart mb-2">
                                      <div class="block  w-auto">
                                        <div class="  text-gray-800 w-auto" role="alert">
                                          <div class="flex border  rounded-md shadow  px-4 py-3" :class="data.user_id == userID ? 'bg-teal-50 border-teal-200' : 'bg-gray-50 border-gray-400'">
                                            <div class="py-1 grow-0 "><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                              </svg></div>
                                            <div class="grow w-auto ">
                                              <p class="font-bold text-teal-900 font-bo5szld">#{{ companyName[0].company_name }}</p>
                                              <div class="py-2">
                                                <div v-html="data.body"></div>
                                              </div>
                                              <div class="font-light text-xs border-dashed border-t border-gray-400 flex items-center py-1 flex justify-start items-center space-x-2">
                                                <span class=""><i class="pi pi-user"></i> By: {{ data.user_name }} </span> <span class="px-1 flex justify-center items-center"> <i class="pi pi-clock"></i> {{ formatDate(data.note_create_at) }}</span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </ScrollPanel>
                      </div>
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
      <!-- DIALOG SIDEBAR ------------------------------------------------------------------------------------------------------------->

      <!-- DIALOG CHAT ----------------------------------------------------------------------------------------------------------------->
      <Dialog header="Line Note" v-model:visible="noteChateDialog" :breakpoints="{ '960px': '75vw', '640px': '90vw' }" :style="{ width: '60vw' }" :modal="true">
        <div class="p-editor-container">
          <ScrollPanel style="width: 100%;" class="h-[360px]  p-2">
            <div class="p-editor-content ql-container ql-snow" style="border:0 !important">
              <div class="ql-editor">
                <div>
                  <div class="w-ful flex justify-center items-center" v-if="noteLine.length == 0">
                    <div class="shadow rounded-2xl w-42 p-5 bg-white dark:bg-gray-800">
                      <div class="flex items-center justify-center pb-2">
                        <span class="">
                          <i class="pi-eraser pi" style="font-size:30px"></i>
                        </span>
                      </div>
                      <div class="flex flex-col justify-start">
                        <p class="text-gray-600 text-md text-left dark:text-white font-bold my-4">
                          No note !
                        </p>
                        <div class="relative w-28 h-2 bg-gray-200 rounded">
                          <div class="absolute top-0 h-2  left-0 rounded bg-green-500 w-2/3">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-if="noteLine.length > 0">
                    <div class="w-auto flex flex-col " v-for="data in noteLine" :key="data">
                      <div class="flex justify-sart mb-2">
                        <div class="block  w-auto">
                          <div class="  text-gray-800 w-auto" role="alert">
                            <div class="flex border  rounded-md shadow  px-4 py-3" :class="data.user_id == userID ? 'bg-teal-50 border-teal-200' : 'bg-gray-50 border-gray-400'">
                              <div class="py-1 grow-0 "><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                  <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                </svg></div>
                              <div class="grow w-auto ">
                                <p class="font-bold text-teal-900 font-bo5szld">#{{ companyName[0].company_name }}</p>
                                <div class="py-2">
                                  <div v-html="data.body"></div>
                                </div>
                                <div class="font-light text-xs border-dashed border-t border-gray-400 flex items-center py-1 flex justify-start items-center space-x-2">
                                  <span class=""><i class="pi pi-user"></i> By: {{ data.user_name }} </span> <span class="px-1 flex justify-center items-center"> <i class="pi pi-clock"></i> {{ formatDate(data.note_create_at) }}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </ScrollPanel>
        </div>
        <div class="py-4">
          <Editor v-model="note.body" editorStyle="height: 220px" />
        </div>
        <template #footer>
          <Button label="Close" icon="pi pi-times" @click="closeModal" class="p-button-text p-button-secondary" />
          <Button label="Post" icon="pi pi-send" @click="postNote" class="p-button p-button-info text-left" />
        </template>
      </Dialog>
      <!-- DIALOG CHAT ----------------------------------------------------------------------------------------------------------------->

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
      dataedit: {},
      showDialog: false,
      noteChateDialog: false,
      actID: "",
      acLineID: "",
      userID: "",
      selectActive: {},
      companyName: "",
      status: [
        { name: 'Active.', code: '1' },
        { name: 'Inactive.', code: '0' },
      ],
      itemsAction: [
        {
          label: 'Options',
          items: [{
            label: 'Renewal',
            icon: 'pi pi-sync',
            command: () => {
              this.$toast.add({ severity: 'success', summary: 'Updated', detail: 'Data Updated' + this.acLineID, life: 3000 });
            }
          },
          {
            label: 'Change Plan',
            icon: 'pi pi-wrench',
            command: () => {
              this.$toast.add({ severity: 'success', summary: 'Updated', detail: 'Data Updated', life: 3000 });

            }
          },
          {
            label: 'Inactive',
            icon: 'pi pi-ban',
            command: () => {
              this.$toast.add({ severity: 'success', summary: 'Updated', detail: 'Data Updated', life: 3000 });

            }
          },
          {
            separator: true
          },
          {
            label: 'More Detail',
            icon: 'pi pi-list',
            command: () => {
              this.$toast.add({ severity: 'success', summary: 'Updated', detail: 'Data Updated', life: 3000 });

            }
          },
          {
            label: 'Note',
            icon: 'pi pi-envelope',
            command: () => {
              this.$store.dispatch('note/GET_NOTE_ACTIVATIONID_ACTIVATIONLINEID', { activation_id: this.actID, activation_line_id: this.acLineID }).then(respnse => {
                this.noteChateDialog = true;
              })

            }
          }
          ]
        },
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
      customer: 'customer/customer',
      products: 'product/products',
      terms: 'activation/terms',
      note: 'note/model_note',
      noteLine: 'note/noteLine',
      noteActivation: 'note/noteActivation',
      user: 'auth/user',
      upload_file: 'upload/upload_file'
    })
  },
  mounted() {
    this.$store.dispatch('activation/GET_ACTIVATION');
    this.$store.dispatch('customer/GET_CUSTOMER');
    this.$store.dispatch('product/GET_PRODUCT');
  },
  methods: {
    // ===================== ACTIVATION  ==================

    //DOUBLE CLICK 
    doubleClick() {
      this.$store.dispatch('activation/GET_ID_ACTIVATION', this.selectActive.id).then(respnse => {
        this.userID = this.user.id;
        this.companyName = this.customers.filter((data) => (data.id == this.activation.customer_id))
        this.$store.dispatch('note/GET_NOTEBY_ACTIVATIONID', this.selectActive.id);
        this.$store.dispatch('upload/GET_UPLOAD_ACTIVATIONID', this.selectActive.id);
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

    // ===================== ACTIVATION  ==================

    // ===================== ACTIVATION LINE ==================

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
            } else {
              switch (term_id) {
                case "1":
                  data.period = 1;
                  break;
                case "2":
                  // 3 Months
                  data.period = 3;
                  break;
                case "3":
                  // 6 Months
                  data.period = 6;
                  break;
                case "4":
                  // Year
                  data.period = 12;
                  break;
                default:
                  // Custom
                  break;
              }
            }
            //IF PERIOD == TRUE
          } else {
            data.term_id = "5";
            var per = data.period;
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
    setActlineId(id) {
      this.acLineID = id;
      this.actID = this.activation.id;
      this.userID = this.user.id;
      this.companyName = this.customers.filter((data) => (data.id == this.activation.customer_id))
      const data = {
        user_id: this.userID,
        activation_id: this.actID,
        activation_line_id: this.acLineID,
      }
      this.$store.commit('note/SET_DATAID', data);
    },
    clickTogle(event) {
      this.$refs.menu_action.toggle(event);
    },
    destroyLine(index) {
      this.$store.commit('activation/REMOVE_ACTIVATION_LINE', index)
    },
    // ===================== ACTIVATION LINE ==================


    // =====================NOTE ------- ==================
    // CAHET 
    postNote() {
      this.$store.dispatch('note/CREATE_NOTE').then(resp => {
        this.$store.dispatch('note/GET_NOTE_ACTIVATIONID_ACTIVATIONLINEID', { activation_id: this.actID, activation_line_id: this.acLineID }).then(respnse => {
          this.$toast.add({ severity: 'success', summary: 'Success', detail: 'Successfully', life: 3000 });
          this.$store.dispatch('note/GET_NOTEBY_ACTIVATIONID', this.actID);

        })
      })
    },
    formatDate(date) {
      return moment.utc(date).local().format("DD-MMM-YYYY hh:mm A z");
    },
    // =====================NOTE ------- ==================

    // =====================UPLOAD FILE ==================
    uploadFile() {
      var data = new FormData()
      var file = this.$refs.files.files[0]
      data.append('files', file);
      data.append('activation_id', this.activation.id),
        this.$store.dispatch('upload/UPLOAD_FILE', { id: this.activation.id, data: data }).then((respnse) => {
          this.$toast.add({ severity: 'success', summary: 'Uploaded', detail: 'Data Uploaded', life: 3000 });
          this.$store.dispatch('upload/GET_UPLOAD_ACTIVATIONID', this.selectActive.id);

        })
    },
    prewViewDoc(name) {
      this.$store.dispatch('upload/PREVIEW_DOC', name);
    }
    // =====================UPLOAD FILE ==================

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