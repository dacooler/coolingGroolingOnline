from ...coord import Coord
from ...size import Size
from ...sized_part import SizedPart
from .wall_opening import WallOpening
from .wall_opening_type import WallOpeningType


class Wall:
    """The wall of a room."""

    position: Coord
    size: Size
    wall_openings: list[WallOpening]
    css_classes: list[str]
    args: list[str]

    _collision_parts: list[SizedPart]
    """Parts of the room that are both visual and have collision."""
    _visual_parts: list[SizedPart]
    """Parts of the room that are only visual and have no collision."""

    def get_visual_cubes(self):
        return self._visual_parts
    
    def get_collision_rects(self):
        return self._collision_parts

    def __init__(self, position: Coord, size: Size, wall_openings: list[WallOpening], css_classes: list[str], is_horizontal: bool, args: list[str]=[]):
        self.position = position
        self.size = size
        self.wall_openings = wall_openings
        self.css_classes = css_classes
        if args:
            self.args = args
        else:
            self.args = []

        self._collision_parts = []
        self._visual_parts = []

        self._generate_parts(is_horizontal)

    def _generate_parts(self, is_horizontal: bool):
        current_wall_part = SizedPart(self.position, self.size, self.css_classes, self.args)
        for wall_opening in sorted(self.wall_openings):
            wall_opening_part = current_wall_part.clone()
            next_wall_part = current_wall_part.clone()

            if is_horizontal:
                wall_opening_part.css_classes.append('horizontal')
                current_wall_part.size.width = self.position.x + wall_opening.position - current_wall_part.position.x

                next_wall_part.position.x = self.position.x + wall_opening.position + wall_opening.width
                next_wall_part.size.width -= current_wall_part.size.width + wall_opening.width

                wall_opening_part.position.x = self.position.x + wall_opening.position
                wall_opening_part.size.width = wall_opening.width

            else:
                wall_opening_part.css_classes.append('vertical')
                current_wall_part.size.height = self.position.y + wall_opening.position - current_wall_part.position.y

                next_wall_part.position.y = self.position.y + wall_opening.position + wall_opening.width
                next_wall_part.size.height -= current_wall_part.size.height + wall_opening.width

                wall_opening_part.position.y = self.position.y + wall_opening.position
                wall_opening_part.size.height = wall_opening.width
            
            if (wall_opening.type == WallOpeningType.DOOR):
                wall_opening_part.size.depth -= WallOpening.DOOR_HEIGHT
                wall_opening_part.css_classes.append('pole')
                self._visual_parts.append(wall_opening_part)
            elif (wall_opening.type == WallOpeningType.WINDOW):
                window_bottom = wall_opening_part.clone()
                wall_opening_part.size.depth -= WallOpening.WINDOW_TOP_HEIGHT
                window_bottom.size.depth = WallOpening.WINDOW_BOTTOM_HEIGHT
                wall_opening_part.css_classes.append('pole')
                window_bottom.css_classes.append('window')
                self._collision_parts.append(wall_opening_part)
                self._collision_parts.append(window_bottom)
            else:
                raise ValueError('Unknown type of Wall Opening')

            self._collision_parts.append(current_wall_part)
            current_wall_part = next_wall_part

        self._collision_parts.append(current_wall_part)
