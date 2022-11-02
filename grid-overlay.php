<style>
.grid-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    display: flex;
    z-index: 160;
}
.grid-overlay .column {
    box-shadow: inset 0px 0px 0px 1px rgba(155, 255, 255, 0.7);
    position: relative;
}
.grid-overlay .column:before,
.grid-overlay .column:after {
    content: '';
    position: absolute;
    top: 0px;
    bottom: 0px;
    width: 15px;
    background-color: rgba(155, 255, 255, 0.1);
}
.grid-overlay .column:before {
    left: 0px;
}
.grid-overlay .column:after {
    right: 0px;
}
</style>
<div class="grid-overlay">
    <div class="wrapper">
        <div class="row">
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
            <div class="column col-xs-1"></div>
        </div>
    </div>
</div>