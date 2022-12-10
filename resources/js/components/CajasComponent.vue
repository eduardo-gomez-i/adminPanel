<template>
  <div class="col-lg-12 col-md-12">
    <div class="row">
      <div class="col-md-2">
        <h3>Caja</h3>
        <select class="form-control" id="exampleFormControlSelect1" v-model="selected" @change="caja()">
          <option value="1">TODAS</option>
          <option value="JV">JV</option>
          <option value="GG">GG</option>
          <option value="C2">C2</option>
        </select>
      </div>
      <div class="col-md-4">
        <h3>Fecha</h3>
        <datepicker name="fecha" :language='es' :format="dateFormat" v-model="fecha" @input="caja()"></datepicker>
      </div>
    </div>
    <div class="card">
      <div class="card-header card-header-tabs card-header-primary">
        <div class="nav-tabs-navigation">
          <div class="nav-tabs-wrapper">
            <ul class="nav nav-tabs" data-tabs="tabs">
              <li class="nav-item">
                <a
                  class="nav-link active show"
                  href="#efectivo"
                  data-toggle="tab"
                  id="efectivoTab"
                  v-on:click="caja"
                >
                  <i class="material-icons">attach_money</i> Efectivo
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#credito" v-on:click="getCredito" data-toggle="tab" id="creditoTab">
                  <i class="material-icons">account_balance</i> Credito
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#tarjeta" v-on:click="getTarjetas" data-toggle="tab" id="tarjetaTab">
                  <i class="material-icons">credit_card</i> Tarjeta
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#cheque" v-on:click="getCheques" data-toggle="tab" id="chequeTab">
                  <i class="material-icons">receipt</i> Cheque y transferencia
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#infonavit" v-on:click="getInfonavit" data-toggle="tab" id="infonavitTab">
                  <i class="material-icons">store</i> Infonavit
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#cancelados" v-on:click="getCancelados" data-toggle="tab" id="canceladosTab">
                  <i class="material-icons">cancel</i> Canceladas
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#depositos" v-on:click="getDepositos" data-toggle="tab" id="depositosTab">
                  <i class="material-icons">attach_money</i> Depositos
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#conekta" v-on:click="getConekta" data-toggle="tab" id="conektaTab">
                  <i class="material-icons">attach_money</i> Conekta
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#link" v-on:click="getLink" data-toggle="tab" id="linkTab">
                  <i class="material-icons">attach_money</i> Remoto Link
                  <div class="ripple-container"></div>
                  <div class="ripple-container"></div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active show" id="efectivo">
            <div>
            <h2>Remisiones</h2>
            <table class="table table-hover table-bordered" id="remisiones">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="remision in datosRemisiones"
                  :key="remision.pagdoc.documento.NUMERO"
                >
                  <td>{{ remision.pagdoc.documento.NUMERO }}</td>
                  <td>{{ remision.FECHA }}</td>
                  <td>{{ remision.HORA }}</td>
                  <td>{{ remision.clientes.NOMBRE }}</td>
                  <td>{{ remision.CANTIDAD }}</td>
                </tr>
              </tbody>
            </table>
            </div>
            <div>
            <h2>Facturas</h2>
            <table class="table table-hover table-bordered" id="facturas">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="factura in datosFacturas"
                  :key="factura.pagdoc.documento.DOCID"
                >
                  <td :id="factura.pagdoc.documento.DOCID">{{ factura.pagdoc.documento.cfd.FOLIO }}</td>
                  <td>{{ factura.FECHA }}</td>
                  <td>{{ factura.HORA }}</td>
                  <td>{{ factura.clientes.NOMBRE }}</td>
                  <td>{{ factura.CANTIDAD }}</td>
                </tr>
              </tbody>
            </table>
            </div>
          </div>
          <div class="tab-pane" id="credito">
            <h2>credito</h2>
            <table class="table table-hover table-bordered" id="tablaCredito">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Total</th>
                  <th>Saldo</th>
                  <th>Restante</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="credito in datosCredito"
                  :key="credito.NUMERO"
                >
                  <td :id="credito.DOCID">{{ credito.NUMERO }}</td>
                  <td>{{ credito.FECHA }}</td>
                  <td>{{ credito.HORA }}</td>
                  <td>{{ credito.clientes.NOMBRE }}</td>
                  <td>{{ credito.TOTAL }}</td>
                  <td>{{ credito.TOTALPAGADO }}</td>
                  <td>{{ credito.RESTANTE }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="tarjeta">
            <h2>tarjeta</h2>
            <table class="table table-hover table-bordered" id="tablaTarjeta">
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Importe</th>
                  <th>Texto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="tarjeta in datosTarjetas"
                  :key="tarjeta.pagdoc.documento.NUMERO"
                >
                  <td>{{ tarjeta.REFERENCIA }}</td>
                  <td>{{ tarjeta.pagdoc.documento.NUMERO }}</td>
                  <td>{{ tarjeta.FECHA }}</td>
                  <td>{{ tarjeta.HORA }}</td>
                  <td>{{ tarjeta.clientes.NOMBRE }}</td>
                  <td>{{ tarjeta.CANTIDAD }}</td>
                  <td>{{ tarjeta.TEXTO }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="cheque">
            <h2>cheque</h2>
            <table class="table table-hover table-bordered" id="tablaCheques">
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Importe</th>
                  <th>Texto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="cheque in datosCheques"
                  :key="cheque.pagdoc.documento.NUMERO"
                >
                  <td>{{ cheque.REFERENCIA }}</td>
                  <td>{{ cheque.pagdoc.documento.NUMERO }}</td>
                  <td>{{ cheque.FECHA }}</td>
                  <td>{{ cheque.HORA }}</td>
                  <td>{{ cheque.clientes.NOMBRE }}</td>
                  <td>{{ cheque.CANTIDAD }}</td>
                  <td>{{ cheque.TEXTO }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="infonavit">
            <h2>infonavit</h2>
            <table class="table table-hover table-bordered" id="tablaInfonavit">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="infonavit in datosInfonavit"
                  :key="infonavit.pagdoc.documento.NUMERO"
                >
                  <td>{{ infonavit.pagdoc.documento.NUMERO }}</td>
                  <td>{{ infonavit.FECHA }}</td>
                  <td>{{ infonavit.HORA }}</td>
                  <td>{{ infonavit.clientes.NOMBRE }}</td>
                  <td>{{ infonavit.CANTIDAD }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="cancelados">
            <h2>cancelados</h2>
            <table class="table table-hover table-bordered" id="tablaCancelados">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="cancelado in datosCancelados"
                  :key="cancelado.NUMERO"
                >
                  <td>{{ cancelado.NUMERO }}</td>
                  <td>{{ cancelado.FECHA }}</td>
                  <td>{{ cancelado.HORA }}</td>
                  <td>{{ cancelado.clientes.NOMBRE }}</td>
                  <td>{{ cancelado.CANTIDAD }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="depositos">
            <h2>Depositos</h2>
            <table class="table table-hover table-bordered" id="tablaDepositos">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="deposito in datosDepositos"
                  :key="deposito.pagdoc.documento.NUMERO"
                >
                  <td>{{ deposito.pagdoc.documento.NUMERO }}</td>
                  <td>{{ deposito.FECHA }}</td>
                  <td>{{ deposito.HORA }}</td>
                  <td>{{ deposito.clientes.NOMBRE }}</td>
                  <td>{{ deposito.CANTIDAD }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="conekta">
            <h2>Conekta</h2>
            <table class="table table-hover table-bordered" id="tablaConekta">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="conekta in datosConekta"
                  :key="conekta.pagdoc.documento.NUMERO"
                >
                  <td>{{ conekta.pagdoc.documento.NUMERO }}</td>
                  <td>{{ conekta.FECHA }}</td>
                  <td>{{ conekta.HORA }}</td>
                  <td>{{ conekta.clientes.NOMBRE }}</td>
                  <td>{{ conekta.CANTIDAD }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tab-pane" id="link">
            <h2>Pago Remoto Link</h2>
            <table class="table table-hover table-bordered" id="tablaLink">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cliente</th>
                  <th>Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="link in datosLink"
                  :key="link.pagdoc.documento.NUMERO"
                >
                  <td>{{ link.pagdoc.documento.NUMERO }}</td>
                  <td>{{ link.FECHA }}</td>
                  <td>{{ link.HORA }}</td>
                  <td>{{ link.clientes.NOMBRE }}</td>
                  <td>{{ link.CANTIDAD }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from "jquery";
import datatable from "datatables.net-bs4";
require("datatables.net-buttons/js/dataTables.buttons");
require("datatables.net-buttons/js/buttons.html5");
import print from "datatables.net-buttons/js/buttons.print";
import jszip from "jszip/dist/jszip";
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'

pdfMake.vfs = pdfFonts.pdfMake.vfs;
window.JSZip = jszip;

export default {
  mounted() {
    this.getEfectivoRemisiones();
    this.getEfectivoFacturas();
  },
  components: {
    Datepicker
  },
  data() {
    return {
      datosRemisiones: [],
      datosFacturas: [],
      datosCredito: [],
      datosTarjetas: [],
      datosCheques: [],
      datosInfonavit: [],
      datosCancelados: [],
      datosDepositos: [],
      datosConekta: [],
      datosLink: [],
      fecha: Date.now(),
      dateFormat : 'yyyy-MM-dd',
      en: en,
      es: es,
      selected: 1
    };
  },
  methods: {
    tabla(nombre) {
      if ( $.fn.DataTable.isDataTable(nombre) ) {
        $(nombre).DataTable().destroy();
      }
      this.$nextTick(() => {
        $(nombre).DataTable({
          //retrieve: true,
          dom:
            "B<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          buttons: [
            {
              extend: "copyHtml5",
              text: '<i class="fa fa-files-o"></i>',
              titleAttr: "Copiar",
              className: "btn btn-secundary",
            },
            {
              extend: "excelHtml5",
              text: '<i class="fa fa-file-excel-o"></i>',
              titleAttr: "Excel",
              className: "btn btn-success",
            },
            {
              extend: "csvHtml5",
              text: '<i class="fa fa-file-text-o"></i>',
              titleAttr: "CSV",
              className: "btn btn-info",
            },
            {
              extend: "pdfHtml5",
              text: '<i class="fa fa-file-pdf-o"></i>',
              titleAttr: "PDF",
              className: "btn btn-danger",
            },
            {
              extend: "print",
              text: "Imprimir",
              titleAttr: "Imprimir",
              className: "btn btn-secundary",
            },
          ],
        });
      });
    },

    caja() {
      if (document.querySelector('.nav-link.active').id == 'efectivoTab') {
        this.getEfectivoRemisiones();
        this.getEfectivoFacturas();
      }else if(document.querySelector('.nav-link.active').id == 'creditoTab'){
        this.getCredito();
      }else if(document.querySelector('.nav-link.active').id == 'tarjetaTab'){
        this.getTarjetas();
      }else if(document.querySelector('.nav-link.active').id == 'chequeTab'){
        this.getCheques();
      }else if(document.querySelector('.nav-link.active').id == 'infonavitTab'){
        this.getInfonavit();
      }else if(document.querySelector('.nav-link.active').id == 'canceladosTab'){
        this.getCancelados();
      }else if(document.querySelector('.nav-link.active').id == 'depositosTab'){
        this.getDepositos();
      }else if(document.querySelector('.nav-link.active').id == 'conektaTab'){
        this.getConekta();
      }else if(document.querySelector('.nav-link.active').id == 'linkTab'){
        this.getLink();
      }
    },
    getCredito() {
      axios.get("credito", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosCredito = res.data;
        this.tabla("#tablaCredito");
      });
    },
    getTarjetas() {
      axios.get("tarjetas", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosTarjetas = res.data;
        this.tabla("#tablaTarjeta");
      });
    },
    getCheques() {
      axios.get("cheques", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosCheques = res.data;
        this.tabla("#tablaCheques");
      });
    },
    getInfonavit() {
      axios.get("infonavit", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosInfonavit = res.data;
        this.tabla("#tablaInfonavit");
      });
    },
    getCancelados() {
      axios.get("cancelados", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosCancelados = res.data;
        this.tabla("#tablaCancelados");
      });
    },
    getDepositos() {
      axios.get("depositos", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosDepositos = res.data;
        this.tabla("#tablaDepositos");
      });
    },
    getConekta() {
      axios.get("conekta", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosConekta = res.data;
        this.tabla("#tablaConekta");
      });
    },
    getLink() {
      axios.get("link", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosLink = res.data;
        this.tabla("#tablaLink");
      });
    },
    getEfectivoRemisiones() {
      axios.get("remisionesEfectivo", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosRemisiones = res.data;
        this.tabla("#remisiones");
      });
    },
    getEfectivoFacturas() {
      axios.get("facturasEfectivo", {
        params: {
          caja: this.selected,
          fecha: new Date(this.fecha).toISOString().split('T')[0]
        }
      }).then((res) => {
        this.datosFacturas = res.data;
        this.tabla("#facturas");
      });
    },
  },
};
</script>
