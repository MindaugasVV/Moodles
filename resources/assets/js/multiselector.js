function OWSMultSelect(elem) {
    if (!(elem instanceof HTMLSelectElement) || !elem.multiple)
        return;

    var myObj = this;

    this.name = elem.name;
    this.fromElement = elem;
    this.fromElement.name = "";
    this.fromElement.ondblclick = function(evt) {
        myObj.promoteSelected();
    };
    var w = document.createElement("div");
    w.setAttribute("class", "msel-wrapper");
    w.setAttribute("title", "Move items from list on the left to the right to choose.");
    w.style.display = "inline-block";
    this.fromElement.parentNode.insertBefore(w, this.fromElement);

    // First cell
    var c = document.createElement("div");
    c.setAttribute("class", "msel-from-wrapper");
    c.style.display = "table-cell";
    w.appendChild(c);

    this.fromSearch = document.createElement("input");
    this.fromSearch.setAttribute("class", "form-control msel-search");
    this.fromSearch.setAttribute("placeholder", "Seach for student");
    this.fromSearch.style.display = "block";
    this.fromSearch.onkeyup = function(evt) {
        myObj.performFromSearch();
    };
    c.appendChild(this.fromSearch);
    c.appendChild(this.fromElement);

    // Button cell
    c = document.createElement("div");
    c.setAttribute("class", "msel-button-wrapper");
    c.style.display = "table-cell";
    c.style.verticalAlign = "middle";
    w.appendChild(c);

    var b = document.createElement("button");
    var i = document.createElement("i");
    b.setAttribute("type", "button");
    b.setAttribute("class", "msel-button-promote btn btn-secondary");
    b.style.display = "block";
    i.setAttribute("class", "fa fa-chevron-right");
    b.appendChild(i);
    b.onclick = function(evt) {
        myObj.promoteSelected();
    };
    c.appendChild(b);

    b = document.createElement("button");
    i = document.createElement("i");
    b.setAttribute("type", "button");
    b.setAttribute("class", "msel-button-demote btn btn-secondary");
    b.style.display = "block";
    i.setAttribute("class", "fa fa-chevron-left");
    b.appendChild(i);
    b.onclick = function(evt) {
        myObj.demoteSelected();
    };
    c.appendChild(b);

    // Results cell
    c = document.createElement("div");
    c.setAttribute("class", "msel-to-wrapper");
    c.style.display = "table-cell";
    w.appendChild(c);

    this.toSearch = document.createElement("input");
    this.toSearch.setAttribute("class", "form-control msel-search");
    this.toSearch.setAttribute("placeholder", "Seach for student");
    this.toSearch.style.display = "block";
    this.toSearch.onkeyup = function(evt) {
        myObj.performToSearch();
    };
    c.appendChild(this.toSearch);

    this.toElement = document.createElement("select");
    this.toElement.setAttribute("class", "form-control msel-selected");
    this.toElement.style.display = "block";
    this.toElement.style.height = "100%";
    this.toElement.style.width = this.fromElement.innerWidth + "px";
    this.toElement.setAttribute("size", this.fromElement.getAttribute("size"));
    this.toElement.ondblclick = function(evt) {
        myObj.demoteSelected();
    };
    c.appendChild(this.toElement);

    // Hidden Elements
    this.payload = document.createElement("div");
    this.payload.setAttribute("class", "msel-payload");
    c.appendChild(this.payload);

    this.payloadMap = {};
    this.fromMap = {};

    // Load any existing ones
    this.promoteSelected();
}

OWSMultSelect.prototype.performFromSearch = function() {
    var term = this.fromSearch.value.trim();
    var re = null;
    if (term.length > 0)
        re = new RegExp(term, "i");
    for (var i = 0; i < this.fromElement.length; i++) {
        var opt = this.fromElement.item(i);
        if (re !== null && !re.test(opt.childNodes[0].nodeValue)) {
            opt.style.display = "none";
        }
        else if (!opt.selected) {
            opt.style.display = "";
        }
    }
};

OWSMultSelect.prototype.performToSearch = function() {
    var term = this.toSearch.value.trim();
    var re = null;
    if (term.length > 0)
        re = new RegExp(term, "i");
    for (var i = 0; i < this.toElement.length; i++) {
        var opt = this.toElement.item(i);
        if (re !== null && !re.test(opt.childNodes[0].nodeValue)) {
            opt.style.display = "none";
        }
        else if (!("mselChosen" in opt.dataset) || opt.dataset.mselChosen != "1") {
            opt.style.display = "";
        }
    }
};

OWSMultSelect.prototype.promoteSelected = function() {
    for (var i = 0; i < this.fromElement.length; i++) {
        var opt = this.fromElement.item(i);
        if (opt.selected) {
            if (!("mselChosen" in opt.dataset) || opt.dataset.mselChosen != "1") {
                this.toElement.appendChild(opt.cloneNode(true));
                opt.dataset.mselChosen = "1";
                opt.style.display = "none";
                var c = document.createElement("input");
                c.type = "hidden";
                c.name = this.name;
                c.value = opt.value;
                this.payload.appendChild(c);
                this.payloadMap[opt.value] = c;
                this.fromMap[opt.value] = opt;
            }
        }
    }
};

OWSMultSelect.prototype.demoteSelected = function() {
    for (var i = 0; i < this.toElement.length; i++) {
        var opt = this.toElement.item(i);
        if (opt.selected) {
            this.toElement.removeChild(opt);
            this.payload.removeChild(this.payloadMap[opt.value]);
            this.fromMap[opt.value].dataset.mselChosen = "0";
            this.fromMap[opt.value].style.display = "";
        }
    }
};



window.addEventListener('load', function(evt) {
    var selects = document.getElementsByTagName("select");
    for (var i = 0; i < selects.length; i++) {
        if (selects[i].multiple)
            new OWSMultSelect(selects[i]);
    }
}, false);