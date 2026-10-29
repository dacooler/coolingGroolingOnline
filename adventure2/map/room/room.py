from ..coord import Coord
from .wall.wall import Wall
from .wall.wall_openings import WallOpenings
from ..size import Size
from ..sized_part import SizedPart
from .wall.wall_argss import WallArgss
from ..html_element import HtmlElement
from ..style import Style


class Room:
    ROOF_THICCNESS = 10

    walls: list[Wall]
    roof: SizedPart 
    """Part with no collision."""

    def get_visual_cubes(self):
        for wall in self.walls:
            for cube in wall.get_visual_cubes():
                yield cube
        yield self.roof

    def get_html_elements(self):
        return self.floor

    def get_collision_rects(self):
        for wall in self.walls:
            for cube in wall.get_collision_rects():
                yield cube

    def __init__(self, position: Coord, size: Size, css_classes: list[str], wall_thickness: float, doors: WallOpenings, wall_args: WallArgss):
        self.walls = wall_args.to_wall_list(position, size, wall_thickness, doors, css_classes)
        self.roof = SizedPart(
            position + (wall_thickness, wall_thickness),
            Size(size.width - wall_thickness, size.height - wall_thickness, Room.ROOF_THICCNESS),
            css_classes=["roof"],
            args=['200px'])

        self.floor = HtmlElement(
            "div",
            style=[
                Style("left", position.x, "px"),
                Style("top", position.y, "px"),
                Style("width", size.width + wall_thickness, "px"),
                Style("height", size.height + wall_thickness, "px"),
            ],
            css_classes=["floor"],
        )
        """
        self.floor = SizedPart(
            position,
            Size(size.width + wall_thickness, size.height + wall_thickness, 1),
            css_classes=["floor"],
        )
        """
