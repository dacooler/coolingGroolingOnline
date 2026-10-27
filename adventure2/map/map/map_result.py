class MapResult:
    colliders: str
    visual_cubes: str
    size: tuple[float, float]
    height_differences: str

    def __init__(self, colliders: str, visual_cubes: str, size: tuple[float, float], height_differences: str):
        self.colliders = colliders
        self.visual_cubes = visual_cubes
        self.size = size
        self.height_differences = height_differences
