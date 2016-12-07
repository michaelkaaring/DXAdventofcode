defmodule Aoc16.Day02 do

  def run do
    part_1 = File.open! "inputs/02_input.txt", fn(pid) ->
      IO.read(pid, :all)
      |> String.trim
      |> process_text(false)
    end

    part_2 = File.open! "inputs/02_input.txt", fn(pid) ->
      IO.read(pid, :all)
      |> String.trim
      |> process_text(true)
    end

    {part_1, part_2}
  end

  def process_text(text, alphanumerical) do
    String.split(text, "\n")
    |> process_line("5", "", alphanumerical)
  end

  defp process_line([h | t], code_character, current_code, alphanumerical) do
    code_character = if alphanumerical do
      process_characters_alphanumeric String.codepoints(h), code_character
    else
      process_characters_numerical String.codepoints(h), code_character
    end

    current_code = current_code <> code_character
    process_line t, code_character, current_code, alphanumerical
  end

  defp process_line([], _, current_code, _) do
    current_code
  end

  defp process_characters_numerical([h | t], current_number) do
    {current_number, _} = Integer.parse current_number

    current_number = case h do
      "U" -> if current_number - 3 >= 1, do: current_number - 3, else: current_number
      "D" -> if current_number + 3 <= 9, do: current_number + 3, else: current_number
      "R" ->
        cond do
          Enum.member?(1..3, current_number) ->
            if Enum.member?(1..2, current_number), do: current_number + 1, else: current_number
          Enum.member?(4..6, current_number) ->
            if Enum.member?(4..5, current_number), do: current_number + 1, else: current_number
          Enum.member?(7..9, current_number) ->
            if Enum.member?(7..8, current_number), do: current_number + 1, else: current_number
        end
      "L" ->
        cond do
          Enum.member?(1..3, current_number) ->
            if Enum.member?(2..3, current_number), do: current_number - 1, else: current_number
          Enum.member?(4..6, current_number) ->
            if Enum.member?(5..6, current_number), do: current_number - 1, else: current_number
          Enum.member?(7..9, current_number) ->
            if Enum.member?(8..9, current_number), do: current_number - 1, else: current_number
        end
    end
    process_characters_numerical t, Integer.to_string(current_number)
  end

  defp process_characters_numerical([], current_number) do
    current_number
  end

  defp process_characters_alphanumeric([h | t], current_number) do
    current_number = case current_number do
      "A" -> "10"
      "B" -> "11"
      "C" -> "12"
      "D" -> "13"
      rest -> rest
    end

    {current_number, _} = Integer.parse current_number

    current_number = case h do
      "U" ->
        cond do
          Enum.member?(1..1, current_number) ->
            current_number
          Enum.member?(2..4, current_number) ->
            if Enum.member?([2, 4], current_number), do: current_number, else: current_number - 2
          Enum.member?(5..9, current_number) ->
            if Enum.member?([5, 9], current_number), do: current_number, else: current_number - 4
          Enum.member?(10..12, current_number) ->
            current_number - 4
          Enum.member?(13..13, current_number) ->
            current_number - 2
        end
      "D" ->
        cond do
          Enum.member?(1..1, current_number) ->
            current_number + 2
          Enum.member?(2..4, current_number) ->
            current_number + 4
          Enum.member?(5..9, current_number) ->
            if Enum.member?([5, 9], current_number), do: current_number, else: current_number + 4
          Enum.member?(10..12, current_number) ->
            if Enum.member?([10, 12], current_number), do: current_number, else: current_number + 2
          Enum.member?(13..13, current_number) ->
            current_number
        end
      "R" ->
        cond do
          Enum.member?(1..1, current_number) ->
            current_number
          Enum.member?(2..4, current_number) ->
            if Enum.member?(2..3, current_number), do: current_number + 1, else: current_number
          Enum.member?(5..9, current_number) ->
            if Enum.member?(5..8, current_number), do: current_number + 1, else: current_number
          Enum.member?(10..12, current_number) ->
            if Enum.member?(10..11, current_number), do: current_number + 1, else: current_number
          Enum.member?(13..13, current_number) ->
            current_number
        end
      "L" ->
        cond do
          Enum.member?(1..1, current_number) ->
            current_number
          Enum.member?(2..4, current_number) ->
            if Enum.member?(3..4, current_number), do: current_number - 1, else: current_number
          Enum.member?(5..9, current_number) ->
            if Enum.member?(6..9, current_number), do: current_number - 1, else: current_number
          Enum.member?(10..12, current_number) ->
            if Enum.member?(11..12, current_number), do: current_number - 1, else: current_number
          Enum.member?(13..13, current_number) ->
            current_number
        end
    end

    current_number = case current_number do
      10 -> "A"
      11 -> "B"
      12 -> "C"
      13 -> "D"
      integer -> Integer.to_string(integer)
    end

    process_characters_alphanumeric t, current_number
  end

  defp process_characters_alphanumeric([], current_number) do
    current_number
  end
end
