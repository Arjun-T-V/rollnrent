document.addEventListener("DOMContentLoaded", function () {
    // Sample bike data
    const bikes = [
        { id: 1, name: "Mountain Bike", price: 20 },
        { id: 2, name: "Road Bike", price: 15 },
        { id: 3, name: "City Bike", price: 10 },
    ];

    // Function to render bikes on the page
    function renderBikes() {
        const bikeListContainer = document.getElementById("bikeList");

        bikes.forEach(bike => {
            const bikeContainer = document.createElement("div");
            bikeContainer.className = "bike-container";

            const bikeName = document.createElement("h2");
            bikeName.textContent = bike.name;

            const rentButton = document.createElement("button");
            rentButton.className = "rent-button";
            rentButton.textContent = `Rent Now - $${bike.price}`;
            rentButton.addEventListener("click", function () {
                alert(`You rented ${bike.name} for $${bike.price}`);
            });

            bikeContainer.appendChild(bikeName);
            bikeContainer.appendChild(rentButton);

            bikeListContainer.appendChild(bikeContainer);
        });
    }

    // Render bikes when the page is loaded
    renderBikes();
});
