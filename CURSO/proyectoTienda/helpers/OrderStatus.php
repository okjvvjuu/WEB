<?php

enum OrderStatus : string {
    case canceled = "Cancelado";
    case pending = "Pendiente de confirmación";
    case confirmed = "Confirmado";
    case sent = "Enviado";
    case delivering = "En reparto";
    case received = "Recibido";
}