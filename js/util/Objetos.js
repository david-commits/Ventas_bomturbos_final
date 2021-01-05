function Servicio(){
    this.idServicio = null;
    this.nombre = null;
    this.idCliente = null;
    this.idProveedor = null;
    this.idSede = null;
    this.fechaInicio = null;
    this.fechaFin = null;
    this.centCosto = [];
    this.centCost = null;
    this.idKey = null;
    this.idSupervisor = null;
    this.supervisor = null;
    this.idTipo = null;
    this.tipo = null;
    this.idEstado = null;
    this.idNombre = null;
    this.idAseCome = null;
    this.cenCost1 = null;
    this.cenCost2 = null;
    this.cenCost3 = null;
    this.cenCost4 = null;
    this.cenCost5 = null;
    this.idfactura = null;
    this.code = null;
    this.codigoSap = null;
    this.cencos = null;
    this.idAsesorCom = null;
    this.sede = null;
    this.cliente = null;
};

function Moneda() {
    this.nombres= null;
};
function User() {
    this.ValInt = 0;
}
function Proveedor1() {
    this.idProveedor = null;
    this.idServicio = null;
    this.proveedorAlterno = null;
    this.idProveedor0 = null;
    this.idPedidoDetalleNE = null;
    this.nombre = null;
    this.precio = null;
    this.moneda = null;
    this.idArticulo = null;
    this.codArticulo = null;
    this.idUnidadMedida = null;
    this.idPeriodo = null;
};

function DetalleCompra() {
    this.idDetallePeridodo = null;
    this.proveedorResponsable = null;
    this.idPedidoDetalle = null;
}

function CabeceraComp() {
    this.comenSap = null;
    this.refacturable = null;
    this.fechaContabilizacion = null;
    this.fechaEntrega = null;
    this.fechaDocumento = null;
    this.idEncargadoCompra = null;
    this.idClaseCompra = null;
    this.idTipoCompra = null;
    this.idAreagasto = null;
    this.lugarEntrega = null;
    this.observacion = null;
    this.descripcionSolicitud = null;
    this.numeroCotizacion = null;
};



function getServicio(row) {
    if (valNull(row.centCost)) {
        row.centCosto = row.centCost.split("-");
    } else if (valNull(row.centCosto)) {
        row.centCost = row.centCosto[0] + '-' + row.centCosto[1] + '-' + row.centCosto[2] + '-' + row.centCosto[3] + '-' + row.centCosto[4];
    }
    return new Object({
        idServicio: row.idServicio,
        nombre: row.nombre,
        idCliente: row.idCliente,
        cliente: row.cliente,
        idSede: row.idSede,
        fechaInicio: row.fechaInicio,
        fechaFin: row.fechaFin,
        centCost: row.centCost,
        centCosto: row.centCosto,
        idKey: row.idKey,
        idTipo: row.idTipo,
        tipo:row.tipo,
        supervisor: row.supervisor,
        idSupervisor: row.idSupervisor,
        idEstado: row.idEstado,
        idNombre: row.idNombre,
        idAseCome: row.idAseCome,
        cenCost1: row.cenCost1,
        cenCost2: row.cenCost2,
        cenCost3: row.cenCost3,
        cenCost4: row.cenCost4,
        cenCost5: row.cenCost5,
        idfactura: row.idfactura,
        code: row.code,
        codigoSap: row.codigoSap,
        cencos: row.cencos
    });
}
function CostoOperativo() {
    this.idKey = null;
    this.idArticulo = null;
    this.idTipoArticulo = null;
    this.idProveedor = null;
    this.precio = null;
    this.depreciacion = null;
    this.utilidad = null;
    this.cantidad = null;
    this.costoMensual = null;
    this.idUnidadMedida = null;
    this.idKey = null;
    this.tipoArticulo = null;
    this.idPeriodo = null;
    this.idArticuloProv = null;
    this.Update = null;
    this.action = null;
};
function Etapa() {
    this.idKey = null;
    this.idEtapa = null;
    this.descripcion = null;
    this.fechaPro = null;
    this.fechaInicio = null;
    this.fechaFin = null;
    this.servicio = null;
    this.sede = null;
    this.cliente = null;
    this.ruc = null;
    this.cargo = null;
    this.telefono = null;
    this.correo = null;
    this.contacto = null;
    this.idUtilidad = null;
    this.valUtil = null;
    this.dirSede = null;
    this.dirDisc = null;
    this.girNeg = null;
}
function getEtapa(row) {
    return new Object({
        idEtapa: row.idEtapa,
        descripcion: row.descripcion,
        fechaPro: row.fechaPro,
        fechaInicio: row.fechaInicio,
        fechaFin: row.fechaFin,
        servicio: row.servicio,
        sede: row.sede,
        cliente: row.cliente,
        ruc: row.ruc,
        cargo: row.cargo,
        telefono: row.telefono,
        correo: row.correo,
        contacto: row.contacto,
        idUtilidad: getNull(row.idUtilidad),
        idKey: row.idKey,
        valUtil: row.valUtil,
        dirSede: row.dirSede,
        dirDisc: row.dirDisc,
        girNeg: row.girNeg
    });
}

function getCostoOperativo(row) {
    return new Object({
        idKey: row.idKey,
        idArticulo: row.idArticulo,
        idTipoArticulo: row.idTipoArticulo,
        idProveedor: row.idProveedor,
        precio: row.precio,
        depreciacion: row.depreciacion,
        utilidad: row.utilidad,
        cantidad: row.cantidad,
        costoMensual: row.costoMensual,
        idUnidadMedida: row.idUnidadMedida,
        tipoArticulo: row.tipoArticulo,
        articulo: row.articulo,
        idPeriodo: row.idPeriodo,
        unidad: row.unidad,
        idArticuloProv: row.idArticuloProv,
        costoTotal: row.costoTotal,
        Update: row.Update,
        action:row.action
    });
}

function Pedido() {
    this.idKey = null;
    this.idPedido = null;
    this.idPeriodo = null;
    this.periodo = null;
    this.idEstado = null;
    this.estado == null;
    this.fechaInicio = null;
    this.fechaFin = null;
}
function getPedido(row) {
    return new Object({
        id: row.id,
        idKey: row.idKey,
        idPedido: row.idPedido,
        idPeriodo: row.idPeriodo,
        periodo: row.periodo,
        idEstado: row.idEstado,
        estado: row.estado,
        fechaInicio: row.fechaInicio,
        fechaFin: row.fechaFin,
        monto: row.monto,
        montoBase: row.montoBase,
        valUtil: row.valUtil,
        observacion: row.observacion
    });
}
var Table = function (active) {
    this.pagination = [5, 10, 20,50,100,150,200];
    this.page = 5;
    this.index = 1;
    this.indexs = [];
    this.result = [];
    this.data = [];
    this.length = [];
    this.active = active;
    this.filtro = '';
    this.resultAll = [];
    this.setResult = function (datos) {
        datos.forEach(function (element, i) {
            element.row = i + 1;
        });
        this.resultAll = datos;
        this.Search();
    };
    this.change = function () {
        this.result = new Array();
        var min = (this.index - 1) * this.page;
        var max = min + this.page;
        for (var i = 0; i < this.length; i++) {
            if (i >= min && i < max) {
                this.result.push(this.data[i]);
            }
        }
    };
    this.add = function (row) {
        this.data.push(row);
        this.length = this.data.length;
        this.changePage(this.page);
    };
    this.changePage = function (pa) {
        this.indexs = new Array();
        for (var i = 0; i < this.length / pa; i++) {
            this.indexs.push(i + 1);
        }
        this.change();
    };
    this.changeIndex = function (ind) {
        if (ind > 0 && ind <= this.indexs.length && ind != this.index) {
            this.index = ind;
            this.change();
        }
    };

    this.Search = function () {
        this.index = 1;
        this.page = this.pagination[0];
        if (this.active) {
            this.data = this.getDataFilter();
            this.length = this.data.length;
            this.changePage(this.page);
        } else {
            this.result = this.getDataFilter();
        }
    };

    this.getDataFilter = function () {
        var str = getNull(this.filtro);
        if (str === null) {
            str = "";
        }
        return this.resultAll.filter(function (item) {
            return includesStr(Object.values(item), str);
        });
    }
};

function includesStr  (values, str) {
    return values.map(function (value) {
        return String(value);
    }).find(function (value) {
        return value.includes(str);
    });
}

var FilterModal = function (url,modal) {
    this.modal = modal;
    this.url = url;
    this.select = new Object();
    this.filter = new Object();
    this.table = new Table(true);
    this.show = function () {
        showModal(this.modal);
    };
    this.SelectRow = function (row) {
        this.select = row;
        hideModal(this.modal);
    };
    this.Search = function () {
        var Tab = this.table;
        axios({
            method: 'POST',
            url: url,
            data: { row: this.filter }
        }).then(function (response) {
            Tab.setResult(response.data.Lista);
        });
    };
    /**/
}


var FilterModalCliente = function (url, modal) {
    this.modal = modal;
    this.url = url;
    this.select = new Object();
    this.filter = new Object();
    this.table = new Table(true);
    this.Sedes = [];
    this.show = function () {
        showModal(this.modal);
    };
    this.SelectRow = function (row) {
        this.select = row;
        hideModal(this.modal);
    };
    this.Search = function () {
        var Tab = this.table;
        axios({
            method: 'POST',
            url: url,
            data: { row: this.filter }
        }).then(function (response) {
            Tab.setResult(response.data.Lista);
        });
    };
}


function InitSecurity() {
    this.comer = false;
    this.super = false;
    this.admin = false;
    this.compr = false;
    this.aseso = false;
}
function GetFalse(count) {
    var val = [];
    for (i = 0; i < count; i++) {
        val[i] = false;
    }
    return val;
}
function FormValidator(act,count) {
    this.active = act;
    this.status = false;
    this.controls = GetFalse(count);
    this.css = function (val,nro) {
        if (this.active) {
            if (!valNull(val)) {
                this.controls[nro-1] = false;
                return "form-control controlApp controlAppVal";
            }
        }
        this.controls[nro-1] = true;
        return "form-control controlApp";
    }
    this.getVal = function () {
       return this.controls.indexOf(false) < 0;
    }
}
function Email() {
    this.mensaje = null;
}
function getEmail(row) {
    return new Object({
        mensaje: row.mensaje
    });
}