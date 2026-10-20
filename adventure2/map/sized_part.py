from coord import Coord
from part import Part
from size import Size
from style import Style


class SizedPart(Part):
    """Class representing a single part. Has a visual cube and a collision rect."""
    size: Size

    def __init__(self, position: Coord, size: Size, css_classes: list[str], args: list[str] = []):
        super().__init__(position, css_classes, args)
        self.size = size

    def get_collision_rect(self):
        """The collision rect of this part. Will be just a simple rectangle div."""
        collision_rect = super().get_collision_rect()
        collision_rect.styles += [
            Style('width', self.size.width, 'px'),
            Style('height', self.size.height, 'px'),
        ]
        return collision_rect

    def get_visual_cube(self):
        """The visual component of this part. Will be a cube with a certain texture."""
        visual_cube = super().get_visual_cube()
        visual_cube.styles += [
            Style('--width', self.size.width, 'px'),
            Style('--height', self.size.height, 'px'),
            Style('--depth', self.size.depth, 'px'),
        ]
        return visual_cube
        
    def clone(self):
        return SizedPart(self.position.clone(), self.size.clone(), list(self.css_classes), list(self.args))