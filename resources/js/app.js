import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import "sweetalert2/dist/sweetalert2.min.css";
import Swal from "sweetalert2";
window.Swal = Swal;
import "./delete-confirm";

Alpine.plugin(collapse);
window.Alpine = Alpine;

Alpine.start();
