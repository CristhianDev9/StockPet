document.addEventListener("DOMContentLoaded", function () {
  const roleRadioButtons = document.querySelectorAll(
    'input[type="radio"][name="usuario_rol"]'
  );
  const nivelTotalFields = document.getElementById("nivelTotalFields");
  nivelTotalFields.style.display = "none";
  roleRadioButtons.forEach((radioButton) => {
    radioButton.addEventListener("change", function () {
      const isChecked = this.checked;
      nivelTotalFields.style.display = isChecked
        ? radioButton.value === "admin"
          ? "block"
          : "none"
        : "none";
    });
  });
});
