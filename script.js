document.querySelectorAll(".toggle-btn").forEach(button => {

    button.addEventListener("click", function () {

        const button = this;
        const id = button.dataset.id;

        const row = button.closest("tr");
        const statusElement = row.querySelector(".status");

        button.disabled = true;

        fetch("toggle.php", {

            method: "POST",

            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },

            body: "id=" + encodeURIComponent(id)

        })

        .then(response => response.text())

        .then(newStatus => {

            newStatus = newStatus.trim();

            statusElement.textContent = newStatus;

            statusElement.classList.remove(
                "status-0",
                "status-1"
            );

            statusElement.classList.add(
                "status-" + newStatus
            );

        })

        .catch(error => {

            console.error("Error:", error);

            alert("Unable to update status.");

        })

        .finally(() => {

            button.disabled = false;

        });

    });

});