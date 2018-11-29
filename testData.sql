-- Test Data For Project
use sd_project;

-- Load Data
INSERT INTO categories VALUES
(1, "Meat"),
(2, "Bread"),
(3, "Drinks"),
(4, "Cleaning Products"),
(5, "Incense"),
(6, "Potatoes"),
(7, "Spice");

INSERT INTO suppliers VALUES
(1, "Sani"),
(2, "Shara"),
(3, "Aswin"),
(4, "Abid"),
(5, "Sebastien");

INSERT INTO units VALUES
(1, "KG", 0),
(2, "Twelve Pack", 1),
(3, "Sacks", 1),
(4, "Boxes", 1),
(5, "G", 0);

INSERT INTO items VALUES
(1, 3, 3, 2, "Beer", 20, 5, NOW()),
(2, 6, 4, 3, "Red Potatoes", 8, 2, NOW()),
(3, 1, 5, 1, "Minced Beef", 7, 1.5, NOW()),
(4, 6, 4, 3, "Blanched Precut", 4, 1, NOW()),
(5, 1, 5, 1, "Bacon", 2, 0.5, NOW()),
(6, 7, 2, 5, "Hot Chili", 700, 80, NOW()),
(7, 4, 4, 4, "Mr. Clean", 8, 2, NOW()),
(8, 3, 3, 2, "7UP", 10, 2, NOW());

